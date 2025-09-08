<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // Arquivo para persistência
    private $usersFile = 'users.json';
    
    private function getUsers()
    {
        try {
            if (Storage::exists($this->usersFile)) {
                $content = Storage::get($this->usersFile);
                $users = json_decode($content, true);
                
                if (json_last_error() === JSON_ERROR_NONE) {
                    return $users;
                }
            }
        } catch (\Exception $e) {
            // Se h erro, retorna array vazio
        }
        
        // Usuários padrão se o arquivo não existir ou estiver corrompido
        return [
            [
                'id' => 1,
                'name' => 'Administrador',
                'email' => 'admin@email.com',
                'password' => 'password',
                'role' => 'admin',
                'created_at' => '2024-01-01 00:00:00'
            ]
        ];
    }
    
    private function saveUsers($users)
    {
        try {
            Storage::put($this->usersFile, json_encode($users, JSON_PRETTY_PRINT));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    // Página de login
    public function showLoginForm()
    {
        if (Session::get('user')) {
            return redirect()->route('home');
        }
        
        return view('pages.login');
    }

    // Processar login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $users = $this->getUsers();

        // Buscar usuário pelo email
        $user = collect($users)->firstWhere('email', $credentials['email']);

        // Verificação em texto puro
        if ($user && $credentials['password'] === $user['password']) {
            // Login bem-sucedido
            Session::put('user', $user);
            Session::put('auth', true);
            Session::put('last_login', now()->toDateTimeString());

            return redirect()->intended($user['role'] === 'admin' ? route('admin.dashboard') : route('home'))
                ->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas',
        ])->withInput($request->only('email'));
    }

    // Processar cadastro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $users = $this->getUsers();

        // Verificar se email já existe
        $existingUser = collect($users)->firstWhere('email', $request->email);
        if ($existingUser) {
            return back()->withErrors([
                'email' => 'Este email já está em uso'
            ])->withInput($request->only('name', 'email'));
        }

        // Criar novo usuário
        $newUser = [
            'id' => count($users) + 1,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user',
            'created_at' => now()->toDateTimeString()
        ];

        // Adicionar e salvar usuários
        $users[] = $newUser;
        $saved = $this->saveUsers($users);

        if (!$saved) {
            return back()->withErrors([
                'email' => 'Erro interno ao criar conta. Tente novamente.'
            ])->withInput($request->only('name', 'email'));
        }

        // Login automático após cadastro
        Session::put('user', $newUser);
        Session::put('auth', true);
        Session::put('last_login', now()->toDateTimeString());

        return redirect()->route('home')
            ->with('success', 'Cadastro realizado com sucesso! Você já está logado.');
    }

    // Logout
    public function logout(Request $request)
    {
        Session::forget('user');
        Session::forget('auth');
        Session::forget('last_login');

        return redirect()->route('home')
            ->with('success', 'Logout realizado com sucesso!');
    }

    // Visualizar usuários (apenas para desenvolvimento)
    public function viewUsers()
    {
        $users = $this->getUsers();
        
        return response()->json([
            'users' => $users,
            'current_user' => Session::get('user'),
            'session_data' => session()->all(),
            'storage_path' => storage_path('app/' . $this->usersFile),
            'file_exists' => Storage::exists($this->usersFile)
        ]);
    }

    // Limpar usuários (apenas para desenvolvimento)
    public function clearUsers()
    {
        if (Storage::exists($this->usersFile)) {
            Storage::delete($this->usersFile);
        }
        
        Session::flush();
        
        return redirect()->route('home')
            ->with('info', 'Sessão e usuários limpos com sucesso!');
    }
}