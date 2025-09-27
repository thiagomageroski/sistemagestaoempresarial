<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ThemeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar se o tema está definido na sessão, caso contrário, usar 'light' como padrão
        if (!session()->has('theme')) {
            session(['theme' => 'light']);
        }
        
        // Compartilhar o tema com todas as views
        view()->share('theme', session('theme'));
        
        return $next($request);
    }
}