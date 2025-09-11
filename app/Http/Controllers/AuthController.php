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
                
                if (json_last_error() === JSON_ERROR_NONE && is_array($users)) {
                    return $users;
                }
            }
        } catch (\Exception $e) {
            // Se houver erro, retorna array vazio
        }
        
        // USUÁRIO ADMIN JÁ CRIADO - PRONTO PARA USO
        // AGORA COM A SENHA CORRETA: admin123
        $adminUser = [
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => 'admin123', // SENHA CORRIGIDA
            'role' => 'admin',
            'created_at' => now()->toDateTimeString()
        ];
        
        // Salvar o admin no arquivo
        $this->saveUsers([$adminUser]);
        
        return [$adminUser];
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
            // Se já estiver logado, redirecionar conforme o tipo de usuário
            $user = Session::get('user');
            return redirect()->intended($user['role'] === 'admin' ? route('admin.dashboard') : route('home'));
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

        // DEBUG: Verificar quais usuários estão sendo retornados
        // \Log::info('Usuários no sistema:', $users);
        // \Log::info('Tentativa de login:', $credentials);

        // Buscar usuário pelo email
        $user = collect($users)->firstWhere('email', $credentials['email']);

        // Verificação em texto puro
        if ($user && $credentials['password'] === $user['password']) {
            // Login bem-sucedido
            Session::put('user', $user);
            Session::put('auth', true);
            Session::put('last_login', now()->toDateTimeString());

            // Redirecionar conforme o tipo de usuário
            if ($user['role'] === 'admin') {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Login administrativo realizado com sucesso!');
            }

            return redirect()->intended(route('home'))
                ->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas. Verifique seu email e senha.',
        ])->withInput($request->only('email'));
    }

    // ... o restante do código permanece igual
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
        $user = Session::get('user');
        Session::flush(); // Limpa toda a sessão

        // Redirecionar conforme o tipo de usuário que estava logado
        if ($user && $user['role'] === 'admin') {
            return redirect()->route('admin.login')
                ->with('success', 'Logout realizado com sucesso!');
        }

        return redirect()->route('home')
            ->with('success', 'Logout realizado com sucesso!');
    }

    // Visualizar usuários (apenas para desenvolvimento)
    public function viewUsers()
    {
        // Verificar se é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return response()->json([
                'error' => 'Acesso não autorizado. Apenas administradores podem visualizar usuários.'
            ], 403);
        }
        
        $users = $this->getUsers();
        
        return response()->json([
            'users' => $users,
            'current_user' => $user,
            'session_data' => session()->all(),
            'storage_path' => storage_path('app/' . $this->usersFile),
            'file_exists' => Storage::exists($this->usersFile)
        ]);
    }

    // Limpar usuários (apenas para desenvolvimento)
    public function clearUsers()
    {
        // Verificar se é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('home')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem executar esta ação.');
        }
        
        if (Storage::exists($this->usersFile)) {
            Storage::delete($this->usersFile);
        }
        
        Session::flush();
        
        return redirect()->route('home')
            ->with('info', 'Sessão e usuários limpos com sucesso!');
    }

    // Método para criar usuário admin (apenas para desenvolvimento)
    public function createAdminUser()
    {
        $users = $this->getUsers();
        
        // Verificar se já existe um admin
        $adminExists = collect($users)->firstWhere('role', 'admin');
        
        if (!$adminExists) {
            // Criar usuário admin padrão
            $adminUser = [
                'id' => count($users) + 1,
                'name' => 'Administrador',
                'email' => 'admin@email.com',
                'password' => 'admin123',
                'role' => 'admin',
                'created_at' => now()->toDateTimeString()
            ];
            
            $users[] = $adminUser;
            $saved = $this->saveUsers($users);
            
            if ($saved) {
                return response()->json([
                    'success' => true,
                    'message' => 'Usuário admin criado com sucesso!',
                    'admin' => [
                        'email' => 'admin@email.com',
                        'password' => 'admin123'
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao salvar usuário admin.'
                ], 500);
            }
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Usuário admin já existe'
        ]);
    }

    // Método para forçar a criação do admin (útil se o arquivo foi corrompido)
    public function forceCreateAdmin()
    {
        // Criar usuário admin padrão
        $adminUser = [
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => 'admin123',
            'role' => 'admin',
            'created_at' => now()->toDateTimeString()
        ];
        
        $saved = $this->saveUsers([$adminUser]);
        
        if ($saved) {
            return response()->json([
                'success' => true,
                'message' => 'Usuário admin criado/recriado com sucesso!',
                'admin' => [
                    'email' => 'admin@email.com',
                    'password' => 'admin123'
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar usuário admin.'
            ], 500);
        }
    }

    // Método para DEBUG - Verificar o arquivo de usuários
    public function debugUsers()
    {
        $path = storage_path('app/' . $this->usersFile);
        $exists = file_exists($path);
        $content = $exists ? file_get_contents($path) : 'Arquivo não existe';
        
        return response()->json([
            'file_exists' => $exists,
            'file_path' => $path,
            'file_content' => $content,
            'decoded_content' => $exists ? json_decode($content, true) : null,
            'current_users' => $this->getUsers()
        ]);
    }
}