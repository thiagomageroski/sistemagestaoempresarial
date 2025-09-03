<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Session::get('auth')) {
            return redirect()->route('admin.dashboard');
        }

        return view('pages.admin.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required', 'string', 'min:3'], // ← Mantido como 'senha'
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email'    => 'E-mail inválido.',
            'senha.required' => 'Informe a senha.',
        ]);

        // Autenticação simples (sem banco) - para admin
        if ($credenciais['email'] === 'admin@empresa.com' && $credenciais['senha'] === 'admin123') {
            Session::put('auth', true);
            Session::put('user', [
                'nome'  => 'Administrador',
                'email' => 'admin@empresa.com',
                'role'  => 'admin',
            ]);

            return redirect()
                ->route('admin.dashboard')
                ->with('status', 'Login realizado com sucesso!');
        }

        // Verifica se é um usuário registrado via sessão
        $registeredUsers = Session::get('registered_users', []);
        foreach ($registeredUsers as $user) {
            if ($user['email'] === $credenciais['email'] && $credenciais['senha'] === $user['senha']) {
                Session::put('auth', true);
                Session::put('user', $user);

                return redirect()
                    ->route('produtos.index')
                    ->with('status', 'Login realizado com sucesso!');
            }
        }

        return back()
            ->withErrors(['email' => 'Credenciais inválidas.'])
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
        // Validação dos dados do formulário (sem verificação de unique no banco)
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

        // Armazena usuários registrados na sessão
        $registeredUsers = Session::get('registered_users', []);
        
        // Verifica se email já existe
        foreach ($registeredUsers as $user) {
            if ($user['email'] === $request->email) {
                return back()
                    ->withErrors(['email' => 'Este e-mail já está em uso.'])
                    ->withInput();
            }
        }

        // Adiciona novo usuário
        $newUser = [
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha, // Em sistema real, isso seria hasheado
            'role' => 'cliente'
        ];

        $registeredUsers[] = $newUser;
        Session::put('registered_users', $registeredUsers);

        // Autentica o usuário automaticamente
        Session::put('auth', true);
        Session::put('user', $newUser);

        return redirect()->route('produtos.index')->with('status', 'Cadastro realizado com sucesso!');
    }
}