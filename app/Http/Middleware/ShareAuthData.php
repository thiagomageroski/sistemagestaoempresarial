<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ShareAuthData
{
    public function handle(Request $request, Closure $next)
    {
        // Compartilha as variáveis com todas as views de forma SEGURA
        $auth = Session::has('auth');
        $user = Session::get('user');
        
        View::share('auth', $auth);
        View::share('user', $user ?? null); // Garante que sempre exista
        
        return $next($request);
    }
}