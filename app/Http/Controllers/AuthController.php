<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    private function getUsersFilePath()
    {
        return storage_path('app/users.json');
    }

    private function loadUsers()
    {
        $path = $this->getUsersFilePath();
        
        if (!file_exists($path)) {
            return [];
        }
        
        $content = file_get_contents($path);
        return json_decode($content, true) ?? [];
    }

    private function saveUsers($users)
    {
        $path = $this->getUsersFilePath();
        file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function showAdminLoginForm()
    {
        if (Session::get('auth')) {
            return redirect()->route('admin.dashboard');
        }

        return view('pages.admin.login');
    }

    public function adminLogin(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required', 'string', 'min:3'],
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email'    => 'E-mail inválido.',
            'senha.required' => 'Informe a senha.',
        ]);

        // Autenticação admin fixa
        if ($credenciais['email'] === 'admin@empresa.com' && $credenciais['senha'] === 'admin123') {
            Session::put('auth', true);
            Session::put('user', [
                'nome'  => 'Administrador',
                'email' => 'admin@empresa.com',
                'role'  => 'admin',
            ]);

            return redirect()
                ->route('admin.dashboard')
                ->with('status', 'Login administrativo realizado com sucesso!');
        }

        return back()
            ->withErrors(['email' => 'Credenciais inválidas.'])
            ->withInput();
    }

    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required', 'string', 'min:6'],
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email'    => 'E-mail inválido.',
            'senha.required' => 'Informe a senha.',
        ]);

        // Carrega usuários do arquivo
        $users = $this->loadUsers();
        
        // Verifica usuários registrados
        foreach ($users as $user) {
            if ($user['email'] === $credenciais['email'] && $credenciais['senha'] === $user['senha']) {
                Session::put('auth', true);
                Session::put('user', $user);

                return redirect()
                    ->route('produtos.index')
                    ->with('status', 'Login realizado com sucesso!');
            }
        }

        return back()
            ->withErrors(['email' => 'E-mail ou senha incorretos.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Session::forget(['auth', 'user']);

        return redirect()
            ->route('home')
            ->with('status', 'Você saiu da sua conta.');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email',
            'senha' => 'required|min:6|confirmed',
        ], [
            'nome.required' => 'Informe o nome completo.',
            'email.required' => 'Informe o e-mail.',
            'email.email' => 'E-mail inválido.',
            'senha.required' => 'Informe a senha.',
            'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'senha.confirmed' => 'A confirmação de senha não corresponde.',
        ]);

        // Carrega usuários existentes
        $users = $this->loadUsers();
        
        // Verifica se email já existe
        foreach ($users as $user) {
            if ($user['email'] === $request->email) {
                return back()
                    ->withErrors(['email' => 'Este e-mail já está em uso.'])
                    ->withInput();
            }
        }

        // Adiciona novo usuário
        $newUser = [
            'id' => uniqid(), // ID único para cada usuário
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha, // Em sistema real, isso seria hasheado
            'role' => 'cliente',
            'data_criacao' => date('Y-m-d H:i:s')
        ];

        $users[] = $newUser;
        $this->saveUsers($users);

        // Autentica o usuário automaticamente
        Session::put('auth', true);
        Session::put('user', $newUser);

        return redirect()->route('produtos.index')->with('status', 'Cadastro realizado com sucesso!');
    }

    // Método para resetar usuários (opcional - para desenvolvimento)
    public function resetUsers()
    {
        $this->saveUsers([]);
        return redirect()->route('home')->with('status', 'Usuários resetados com sucesso!');
    }
}