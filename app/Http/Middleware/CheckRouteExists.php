<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckRouteExists
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Tenta encontrar a rota
            $route = Route::getRoutes()->match($request);
            return $next($request);
        } catch (\Exception $e) {
            // Se não encontrar, retorna a view de fallback
            return response()->view('pages.naoexiste', [], 404);
        }
    }
}