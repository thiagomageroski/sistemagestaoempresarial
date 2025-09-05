<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Array simulando um "banco de dados" de usuários
    private $users = [
        [
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => 'password', // Senha em texto puro
            'role' => 'admin',
            'created_at' => '2024-01-01 00:00:00'
        ],
        [
            'id' => 2,
            'name' => 'João Silva',
            'email' => 'joao@email.com',
            'password' => 'password', // Senha em texto puro
            'role' => 'user',
            'created_at' => '2024-01-02 00:00:00'
        ],
        [
            'id' => 3,
            'name' => 'Maria Santos',
            'email' => 'maria@email.com',
            'password' => 'password', // Senha em texto puro
            'role' => 'user',
            'created_at' => '2024-01-03 00:00:00'
        ]
    ];

    // Página de login
    public function showLoginForm()
    {
        if (Session::get('user')) {
            return redirect()->route('home');
        }
        
        return view('pages.login');
    }

    // Processar login - CORRIGIDO
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        // Buscar usuário pelo email
        $user = collect($this->users)->firstWhere('email', $credentials['email']);

        // CORREÇÃO: Verificar senha em texto puro, não com Hash::check
        if ($user && $credentials['password'] === $user['password']) {
            // Login bem-sucedido - SALVAR AMBOS PARA CONSISTÊNCIA
            Session::put('user', $user);
            Session::put('auth', true);
            Session::put('last_login', now()->toDateTimeString());

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login realizado com sucesso!',
                    'redirect' => $user['role'] === 'admin' ? route('admin.dashboard') : route('home')
                ]);
            }

            return redirect()->intended($user['role'] === 'admin' ? route('admin.dashboard') : route('home'))
                ->with('success', 'Login realizado com sucesso!');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas',
        ])->withInput($request->only('email'));
    }

    // Página de cadastro
    public function showRegisterForm()
    {
        if (Session::get('user')) {
            return redirect()->route('home');
        }
        
        return view('pages.cadastro');
    }

    // Processar cadastro - CORRIGIDO
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Verificar se email já existe
        $existingUser = collect($this->users)->firstWhere('email', $request->email);
        if ($existingUser) {
            return back()->withErrors([
                'email' => 'Este email já está em uso'
            ])->withInput($request->only('name', 'email'));
        }

        // Criar novo usuário (simulado)
        $newUser = [
            'id' => count($this->users) + 1,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Senha em texto puro
            'role' => 'user',
            'created_at' => now()->toDateTimeString()
        ];

        // Adicionar ao "banco de dados" (em produção, salvaria no banco real)
        $this->users[] = $newUser;

        // Login automático após cadastro - SALVAR AMBOS PARA CONSISTÊNCIA
        Session::put('user', $newUser);
        Session::put('auth', true);
        Session::put('last_login', now()->toDateTimeString());

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cadastro realizado com sucesso!',
                'redirect' => route('home')
            ]);
        }

        return redirect()->route('home')
            ->with('success', 'Cadastro realizado com sucesso! Você já está logado.');
    }

    // Logout
    public function logout(Request $request)
    {
        // Limpar AMBOS os valores de sessão
        Session::forget('user');
        Session::forget('auth');
        Session::forget('last_login');
        Session::flush();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Logout realizado com sucesso!',
                'redirect' => route('home')
            ]);
        }

        return redirect()->route('home')
            ->with('success', 'Logout realizado com sucesso!');
    }

    // Login administrativo - CORRIGIDO
    public function showAdminLoginForm()
    {
        if (Session::get('user')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('pages.admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $user = collect($this->users)->firstWhere('email', $credentials['email']);

        // CORREÇÃO: Verificar senha em texto puro
        if ($user && $credentials['password'] === $user['password'] && $user['role'] === 'admin') {
            // Login administrativo - SALVAR AMBOS PARA CONSISTÊNCIA
            Session::put('user', $user);
            Session::put('auth', true);
            Session::put('last_login', now()->toDateTimeString());

            return redirect()->route('admin.dashboard')
                ->with('success', 'Login administrativo realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas ou acesso não autorizado',
        ])->withInput($request->only('email'));
    }

    // Visualizar usuários (apenas para desenvolvimento)
    public function viewUsers()
    {
        return response()->json([
            'users' => $this->users,
            'current_user' => Session::get('user'),
            'session_data' => session()->all()
        ]);
    }

    // Limpar usuários (apenas para desenvolvimento)
    public function clearUsers()
    {
        // Esta função é apenas para desenvolvimento
        Session::flush();
        
        return redirect()->route('home')
            ->with('info', 'Sessão limpa com sucesso!');
    }

    // Verificar autenticação (para AJAX)
    public function checkAuth()
    {
        return response()->json([
            'authenticated' => !!Session::get('user'),
            'user' => Session::get('user'),
            'is_admin' => Session::get('user') && Session::get('user')['role'] === 'admin'
        ]);
    }
}