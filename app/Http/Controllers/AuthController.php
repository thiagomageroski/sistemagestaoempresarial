<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    private function userExists($email)
    {
        $users = $this->loadUsers();
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return true;
            }
        }
        return false;
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

        // Autenticação admin
        if ($credenciais['email'] === 'admin@empresa.com' && $credenciais['senha'] === 'admin123') {
            Session::put('auth', true);
            Session::put('user', [
                'nome'  => 'Administrador',
                'email' => 'admin@empresa.com',
                'role'  => 'admin',
            ]);

            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login administrativo realizado com sucesso!');
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

        // Verifica usuários registrados
        $users = $this->loadUsers();
        
        foreach ($users as $user) {
            if ($user['email'] === $credenciais['email'] && $credenciais['senha'] === $user['senha']) {
                Session::put('auth', true);
                Session::put('user', $user);

                return redirect()
                    ->route('produtos.index')
                    ->with('success', 'Login realizado com sucesso!');
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
            ->with('success', 'Você saiu da sua conta.');
    }

    public function register(Request $request)
    {
        // Validação dos dados do formulário
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

        // Verifica se o email já existe
        if ($this->userExists($request->email)) {
            return back()
                ->withErrors(['email' => 'Este e-mail já está cadastrado.'])
                ->withInput();
        }

        // Carrega usuários existentes
        $users = $this->loadUsers();

        // Adiciona novo usuário
        $newUser = [
            'id' => uniqid(),
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha,
            'role' => 'cliente',
            'data_criacao' => date('Y-m-d H:i:s')
        ];

        $users[] = $newUser;
        $this->saveUsers($users);

        // Autentica o usuário automaticamente
        Session::put('auth', true);
        Session::put('user', $newUser);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Cadastro realizado com sucesso! Bem-vindo à TechStore!');
    }

    // Método para visualizar usuários (apenas para desenvolvimento)
    public function viewUsers()
    {
        $users = $this->loadUsers();
        return response()->json($users);
    }

    // Método para limpar usuários (apenas para desenvolvimento)
    public function clearUsers()
    {
        $this->saveUsers([]);
        Session::forget(['auth', 'user']);
        return redirect()->route('home')->with('info', 'Usuários resetados.');
    }
}