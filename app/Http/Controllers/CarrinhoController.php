<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    private function calculateItemCount($carrinho)
    {
        if (!is_array($carrinho) || empty($carrinho)) {
            return 0;
        }
        
        $count = 0;
        foreach ($carrinho as $item) {
            if (isset($item['quantidade'])) {
                $count += $item['quantidade'];
            }
        }
        return $count;
    }

    private function updateCartCount($carrinho)
    {
        $itemCount = $this->calculateItemCount($carrinho);
        Session::put('carrinho_count', $itemCount);
        return $itemCount;
    }

    public function index()
    {
        if (!Session::get('user')) {
            return redirect()->route('login')
                ->with('error', 'Faça login para acessar seu carrinho de compras');
        }

        $carrinho = Session::get('carrinho', []);
        $total = $this->calculateTotal($carrinho);

        $this->updateCartCount($carrinho);

        return view('pages.carrinho', compact('carrinho', 'total'));
    }

    public function adicionar(Request $request)
    {
        try {
            if (!Session::get('user')) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Faça login para adicionar produtos ao carrinho'
                    ], 401);
                }
                return redirect()->route('login')
                    ->with('error', 'Faça login para adicionar produtos ao carrinho');
            }

            $request->validate([
                'produto_id' => 'required|integer|min:1',
                'quantidade' => 'required|integer|min:1'
            ]);

            $produtoId = $request->input('produto_id');
            $carrinho = Session::get('carrinho', []);

            $produto = Produto::find($produtoId);

            if (!$produto) {
                throw new \Exception('Produto não encontrado');
            }

            $estoque = 100;

            $produtoData = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => floatval($produto->preco),
                'quantidade' => intval($request->input('quantidade', 1)),
                'imagem' => $produto->imagem,
                'estoque' => $estoque
            ];

            if (isset($carrinho[$produtoId])) {
                $carrinho[$produtoId]['quantidade'] += $produtoData['quantidade'];
            } else {
                $carrinho[$produtoId] = $produtoData;
            }

            Session::put('carrinho', $carrinho);
            
            $itemCount = $this->updateCartCount($carrinho);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'carrinho' => $carrinho,
                    'itemCount' => $itemCount
                ]);
            }

            return redirect()->back()
                ->with('success', 'Produto adicionado ao carrinho!')
                ->with('carrinho_count', $itemCount);

        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao adicionar produto ao carrinho: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                ->with('error', 'Erro ao adicionar produto ao carrinho: ' . $e->getMessage());
        }
    }

    public function remover($produtoId)
    {
        try {
            if (!Session::get('user')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sessão expirada. Faça login novamente.'
                ], 401);
            }

            $carrinho = Session::get('carrinho', []);

            if (!isset($carrinho[$produtoId])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produto não encontrado no carrinho!'
                ], 404);
            }

            // Remover o produto
            unset($carrinho[$produtoId]);
            
            // Atualizar a sessão
            Session::put('carrinho', $carrinho);
            
            // Atualizar a contagem de itens na sessão
            $itemCount = $this->updateCartCount($carrinho);

            return response()->json([
                'success' => true,
                'message' => 'Produto removido do carrinho!',
                'carrinho' => $carrinho,
                'total' => $this->calculateTotal($carrinho),
                'itemCount' => $itemCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao remover produto do carrinho!'
            ], 500);
        }
    }

    public function atualizar(Request $request, $produtoId)
    {
        try {
            if (!Session::get('user')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sessão expirada. Faça login novamente.'
                ], 401);
            }

            $request->validate([
                'quantidade' => 'required|integer|min:1'
            ]);

            $carrinho = Session::get('carrinho', []);

            if (!isset($carrinho[$produtoId])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produto não encontrado no carrinho!'
                ], 404);
            }

            // Buscar produto no BANCO DE DADOS para verificar se ainda existe
            $produto = Produto::find($produtoId);

            if (!$produto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produto não encontrado!'
                ], 404);
            }

            // Como não temos estoque, vamos usar um valor padrão
            $estoque = 100; // Valor padrão

            if ($request->quantidade > $estoque) {
                return response()->json([
                    'success' => false,
                    'message' => 'Estoque insuficiente. Disponível: ' . $estoque
                ], 400);
            }

            $carrinho[$produtoId]['quantidade'] = intval($request->input('quantidade'));
            
            Session::put('carrinho', $carrinho);
            
            // Atualizar a contagem de itens na sessão
            $itemCount = $this->updateCartCount($carrinho);

            return response()->json([
                'success' => true,
                'message' => 'Quantidade atualizada com sucesso!',
                'carrinho' => $carrinho,
                'total' => $this->calculateTotal($carrinho),
                'itemCount' => $itemCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar quantidade do produto!'
            ], 500);
        }
    }

    public function limpar()
    {
        try {
            if (!Session::get('user')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sessão expirada. Faça login novamente.'
                ], 401);
            }

            // Limpar carrinho
            Session::forget('carrinho');
            Session::put('carrinho_count', 0);

            return response()->json([
                'success' => true,
                'message' => 'Carrinho limpo com sucesso!',
                'itemCount' => 0
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao limpar carrinho!'
            ], 500);
        }
    }

    public function quantidade()
    {
        $carrinho = Session::get('carrinho', []);
        $itemCount = $this->calculateItemCount($carrinho);
        
        return response()->json([
            'success' => true,
            'quantidade' => $itemCount
        ]);
    }

    public function verificarEstoque()
    {
        try {
            $carrinho = Session::get('carrinho', []);
            $estoqueInsuficiente = [];

            foreach ($carrinho as $produtoId => $item) {
                // Buscar produto no BANCO DE DADOS
                $produto = Produto::find($produtoId);
                
                if (!$produto) {
                    $estoqueInsuficiente[] = "Produto {$item['nome']} não encontrado";
                    continue;
                }

                // Como não temos estoque, vamos usar um valor padrão
                $estoque = 100; // Valor padrão

                if ($item['quantidade'] > $estoque) {
                    $estoqueInsuficiente[] = "{$item['nome']} (estoque: {$estoque}, solicitado: {$item['quantidade']})";
                }
            }

            return response()->json([
                'success' => true,
                'estoqueInsuficiente' => $estoqueInsuficiente,
                'temEstoque' => empty($estoqueInsuficiente)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao verificar estoque!'
            ], 500);
        }
    }

    private function calculateTotal($carrinho)
    {
        if (!is_array($carrinho) || empty($carrinho)) {
            return 0;
        }
        
        $total = 0;
        foreach ($carrinho as $item) {
            if (isset($item['preco']) && isset($item['quantidade'])) {
                $total += $item['preco'] * $item['quantidade'];
            }
        }
        return round($total, 2);
    }
}