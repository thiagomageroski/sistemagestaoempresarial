<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $mode = 'auth'): Response
    {
        $isAuthenticated = Auth::check();

        if ($mode === 'auth') {
            // Modo: requer autenticação
            if (!$isAuthenticated) {
                return $this->handleUnauthenticated($request, 'Por favor, faça login para acessar esta página.');
            }
        } elseif ($mode === 'guest') {
            // Modo: requer que NÃO esteja autenticado
            if ($isAuthenticated) {
                return $this->handleAlreadyAuthenticated($request, 'Você já está logado.');
            }
        }

        return $next($request);
    }

    /**
     * Handle unauthenticated requests.
     */
    protected function handleUnauthenticated(Request $request, string $message)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'redirect' => route('login'),
                'error' => 'unauthenticated'
            ], 401);
        }

        return redirect()->route('login')
            ->with('warning', $message)
            ->with('redirect', url()->current());
    }

    /**
     * Handle already authenticated requests for guest routes.
     */
    protected function handleAlreadyAuthenticated(Request $request, string $message)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'redirect' => route('home'),
                'error' => 'already_authenticated'
            ], 403);
        }

        return redirect()->route('home')
            ->with('info', $message);
    }
}