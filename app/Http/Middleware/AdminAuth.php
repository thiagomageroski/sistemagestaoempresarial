<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Session::get('user');
        
        // Verificar se o usuário está autenticado e é administrador
        if (!$user || $user['role'] !== 'admin') {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Acesso não autorizado. Apenas administradores podem acessar esta área.',
                    'redirect' => route('admin.login')
                ], 403);
            }
            
            return redirect()->route('admin.login')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem acessar esta área.');
        }

        return $next($request);
    }
}