<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado (via sessão)
        if (!Session::get('auth')) {
            // Redireciona para a página de cadastro com uma mensagem
            return redirect()->route('cadastro')->with('error', 'Você precisa se cadastrar para acessar nossos produtos.');
        }

        return $next($request);
    }
}