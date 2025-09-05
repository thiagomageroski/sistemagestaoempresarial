<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CustomAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // VERIFICAÇÃO CORRIGIDA: usar 'user' em vez de 'auth' para ser consistente
        if (!Session::get('user')) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Faça login para acessar esta página',
                    'redirect' => route('login')
                ], 401);
            }
            
            return redirect()->route('login')
                ->with('warning', 'Faça login para acessar esta página');
        }

        return $next($request);
    }
}