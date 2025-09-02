<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('pages.admin.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:3'], // ← Alterado para 'password'
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email'    => 'E-mail inválido.',
            'password.required' => 'Informe a senha.', // ← Alterado para 'password'
        ]);

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();

            return redirect()
                ->route('admin.dashboard')
                ->with('status', 'Login realizado com sucesso!');
        }

        return back()
            ->withErrors(['email' => 'Credenciais inválidas.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('status', 'Você saiu da sua conta.');
    }

    public function register(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'name' => 'required|max:255', // ← Alterado para 'name'
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // ← Alterado para 'password'
        ], [
            'name.required' => 'Informe o nome completo.',
            'email.required' => 'Informe o e-mail.',
            'email.email' => 'E-mail inválido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'Informe a senha.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação de senha não corresponde.',
        ]);

        // Criar usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Autenticar usuário
        Auth::login($user);

        // Redireciona para a página de produtos
        return redirect()->route('produtos.index')->with('status', 'Cadastro realizado com sucesso!');
    }
}