<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Se a rota for de cadastro ou login e o usuário JÁ ESTIVER autenticado
        if ($request->routeIs('cadastro') || $request->routeIs('login')) {
            if (Session::get('auth')) {
                return redirect()->route('produtos.index');
            }
        }
        // Se for qualquer outra rota protegida e o usuário NÃO ESTIVER autenticado
        elseif (!Session::get('auth')) {
            return redirect()->route('login')->with('error', 'Você precisa fazer login para acessar esta página.');
        }

        return $next($request);
    }
}