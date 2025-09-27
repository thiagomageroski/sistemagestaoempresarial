<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    public function handle(Request $request, Closure $next, $mode = 'auth'): Response
    {
        $isAuthenticated = Session::get('user') !== null;

        if ($mode === 'auth') {
            if (!$isAuthenticated) {
                return $this->handleUnauthenticated($request, 'Por favor, faça login para acessar esta página.');
            }
        } elseif ($mode === 'guest') {
            if ($isAuthenticated) {
                return $this->handleAlreadyAuthenticated($request, 'Você já está logado.');
            }
        }

        return $next($request);
    }

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