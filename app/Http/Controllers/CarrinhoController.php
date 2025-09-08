<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarrinhoController extends Controller
{
    private function produtos()
    {
        return [
            [
                'id' => 1,
                'slug' => 'fone-ouvido-premium',
                'nome' => 'Fone de Ouvido Premium com Cancelamento de Ruído',
                'preco' => 599.90,
                'categoria' => 'Áudio',
                'descricao' => 'Fone de ouvido premium com cancelamento de ruído ativo, bateria de 30 horas.',
                'imagem' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80',
                'destaque' => true,
                'estoque' => 15
            ],
            [
                'id' => 2,
                'slug' => 'smartwatch-inteligente',
                'nome' => 'Smartwatch Inteligente com Monitor Cardíaco',
                'preco' => 399.90,
                'categoria' => 'Wearables',
                'descricao' => 'Smartwatch com monitor cardíaco, GPS e bateria de 7 dias.',
                'imagem' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80',
                'destaque' => true,
                'estoque' => 20
            ],
            [
                'id' => 3,
                'slug' => 'caixa-som-bluetooth',
                'nome' => 'Caixa de Som Bluetooth à Prova D\'água',
                'preco' => 299.90,
                'categoria' => 'Áudio',
                'descricao' => 'Caixa de som Bluetooth à prova d\'água com 20 horas de bateria.',
                'imagem' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80',
                'destaque' => false,
                'estoque' => 25
            ],
            [
                'id' => 4,
                'slug' => 'notebook-ultrafino',
                'nome' => 'Notebook Ultrafino 15.6" 16GB RAM',
                'preco' => 4299.90,
                'categoria' => 'Computadores',
                'descricao' => 'Notebook ultrafino com 16GB RAM, SSD 512GB e processador Intel i7.',
                'imagem' => 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80',
                'destaque' => true,
                'estoque' => 10
            ],
            [
                'id' => 5,
                'slug' => 'teclado-mecanico-rgb',
                'nome' => 'Teclado Mecânico RGB Switch Azul',
                'preco' => 499.90,
                'categoria' => 'Periféricos',
                'descricao' => 'Teclado mecânico RGB com switches Blue e construção em alumínio.',
                'imagem' => 'https://images.unsplash.com/photo-1531297484001-80022131f5a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80',
                'destaque' => false,
                'estoque' => 30
            ],
            [
                'id' => 6,
                'slug' => 'headphone-gaming',
                'nome' => 'Headphone Gaming 7.1 Surround Sound',
                'preco' => 349.90,
                'categoria' => 'Gaming',
                'descricao' => 'Headphone gaming com som surround 7.1 e microfone integrado.',
                'imagem' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80',
                'destaque' => false,
                'estoque' => 18
            ],
            [
                'id' => 7,
                'slug' => 'smartphone-premium',
                'nome' => 'Smartphone Premium 256GB Câmera Tripla 108MP',
                'preco' => 2899.90,
                'categoria' => 'Smartphones',
                'descricao' => 'Smartphone premium com câmera tripla de 108MP e 256GB de armazenamento.',
                'imagem' => 'https://images.unsplash.com/photo-1708622366440-5ac82d30da10?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'destaque' => true,
                'estoque' => 12
            ],
            [
                'id' => 8,
                'slug' => 'tablet-premium',
                'nome' => 'Tablet Premium 10.9" 256GB com Caneta Stylus',
                'preco' => 1899.90,
                'categoria' => 'Tablets',
                'descricao' => 'Tablet premium com caneta stylus e 256GB de armazenamento.',
                'imagem' => 'https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80',
                'destaque' => false,
                'estoque' => 8
            ]
        ];
    }

    // Função para calcular o total de itens no carrinho
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

    // Função para atualizar a contagem de itens na sessão
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

        // Atualizar a contagem de itens
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
                'produto_id' => 'required|integer|min:1|max:8',
                'quantidade' => 'required|integer|min:1'
            ]);

            $produtoId = $request->input('produto_id');
            $carrinho = Session::get('carrinho', []);

            $produtos = $this->produtos();
            $produto = collect($produtos)->firstWhere('id', $produtoId);

            if (!$produto) {
                throw new \Exception('Produto não encontrado');
            }

            $produtoData = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'preco' => floatval($produto['preco']),
                'quantidade' => intval($request->input('quantidade', 1)),
                'imagem' => $produto['imagem'],
                'slug' => $produto['slug']
            ];

            if (isset($carrinho[$produtoId])) {
                $carrinho[$produtoId]['quantidade'] += $produtoData['quantidade'];
            } else {
                $carrinho[$produtoId] = $produtoData;
            }

            Session::put('carrinho', $carrinho);
            
            // Atualizar a contagem de itens na sessão
            $itemCount = $this->updateCartCount($carrinho);

            // Se for requisição AJAX (do JavaScript), retorna JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'carrinho' => $carrinho,
                    'itemCount' => $itemCount
                ]);
            }

            // Se for requisição normal de formulário, redireciona
            return redirect()->back()
                ->with('success', '')
                ->with('carrinho_count', $itemCount);

        } catch (\Exception $e) {
            // Se for requisição AJAX, retorna JSON de erro
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao adicionar produto ao carrinho: ' . $e->getMessage()
                ], 500);
            }
            
            // Se for requisição normal, redireciona com erro
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