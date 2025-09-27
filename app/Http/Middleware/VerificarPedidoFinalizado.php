<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class VerificarPedidoFinalizado
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar se o usuário está autenticado
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Faça login para acessar esta página.');
        }

        // Verificar se há um pedido finalizado na sessão
        $pedidoFinalizado = Session::get('pedido_finalizado', false);
        
        if (!$pedidoFinalizado) {
            return redirect()->route('home')
                ->with('error', 'Acesso não autorizado. Complete uma compra para acessar esta página.');
        }

        return $next($request);
    }
}