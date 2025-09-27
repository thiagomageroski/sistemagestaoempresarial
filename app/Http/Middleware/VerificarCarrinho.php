<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarCarrinho
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
        // Verificar se o carrinho existe e não está vazio
        $carrinho = session()->get('carrinho', []);
        
        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Seu carrinho está vazio. Adicione produtos antes de finalizar a compra.');
        }

        return $next($request);
    }
}