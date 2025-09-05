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
                'slug' => 'notebook-pro-15',
                'nome' => 'Notebook Pro 15',
                'preco' => 7999.90,
                'categoria' => 'Informática',
                'descricao' => 'Notebook profissional com 16GB RAM, SSD 512GB. Processador Intel i7, placa de vídeo dedicada.',
                'imagem' => 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'destaque' => true,
                'estoque' => 15
            ],
            [
                'id' => 2,
                'slug' => 'mouse-ergonomico',
                'nome' => 'Mouse Ergonômico',
                'preco' => 199.90,
                'categoria' => 'Acessórios',
                'descricao' => 'Mouse ergonômico com design confortável para longas horas de uso. Conexão wireless.',
                'imagem' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'destaque' => false,
                'estoque' => 42
            ],
            [
                'id' => 3,
                'slug' => 'monitor-27-4k',
                'nome' => 'Monitor 27" 4K',
                'preco' => 2499.90,
                'categoria' => 'Periféricos',
                'descricao' => 'Monitor 4K UHD de 27 polegadas com taxa de atualização de 144Hz. Perfect para designers.',
                'imagem' => 'https://images.unsplash.com/photo-1546538915-a9e2c8d0a5df?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'destaque' => true,
                'estoque' => 8
            ],
            [
                'id' => 4,
                'slug' => 'teclado-mecanico',
                'nome' => 'Teclado Mecânico RGB',
                'preco' => 499.90,
                'categoria' => 'Acessórios',
                'descricao' => 'Teclado mecânico com switches Blue, iluminação RGB personalizável e construção em alumínio.',
                'imagem' => 'https://images.unsplash.com/photo-1541140532154-b024d705b90a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'destaque' => false,
                'estoque' => 25
            ],
            [
                'id' => 5,
                'slug' => 'headphone-bluetooth',
                'nome' => 'Headphone Bluetooth',
                'preco' => 349.90,
                'categoria' => 'Áudio',
                'descricao' => 'Headphone wireless com cancelamento de ruído ativo, bateria de 30 horas.',
                'imagem' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'destaque' => true,
                'estoque' => 18
            ],
            [
                'id' => 6,
                'slug' => 'webcam-4k',
                'nome' => 'Webcam 4K',
                'preco' => 399.90,
                'categoria' => 'Acessórios',
                'descricao' => 'Webcam 4K com microfone integrado and ajuste automático de foco.',
                'imagem' => 'https://images.unsplash.com/photo-1531297484001-80022131f5a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'destaque' => false,
                'estoque' => 30
            ]
        ];
    }

    public function index()
    {
        // CORRIGIDO: Alterado de 'auth' para 'user'
        if (!Session::get('user')) {
            return redirect()->route('login')
                ->with('error', 'Faça login para acessar seu carrinho de compras');
        }

        $carrinho = Session::get('carrinho', []);
        $total = $this->calculateTotal($carrinho);

        return view('pages.carrinho', compact('carrinho', 'total'));
    }

    public function adicionar(Request $request)
    {
        try {
            // CORRIGIDO: Alterado de 'auth' para 'user'
            if (!Session::get('user')) {
                return redirect()->route('login')
                    ->with('error', 'Faça login para adicionar produtos ao carrinho');
            }

            $request->validate([
                'produto_id' => 'required|integer|min:1|max:6',
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

            return redirect()->back()
                ->with('success', 'Produto adicionado ao carrinho!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao adicionar produto ao carrinho: ' . $e->getMessage());
        }
    }

    public function remover($produtoId)
    {
        try {
            // CORRIGIDO: Alterado de 'auth' para 'user'
            if (!Session::get('user')) {
                return redirect()->route('login')
                    ->with('error', 'Sessão expirada. Faça login novamente.');
            }

            $carrinho = Session::get('carrinho', []);

            if (!isset($carrinho[$produtoId])) {
                return redirect()->route('carrinho.index')
                    ->with('error', 'Produto não encontrado no carrinho!');
            }

            unset($carrinho[$produtoId]);
            
            Session::put('carrinho', $carrinho);

            return redirect()->route('carrinho.index')
                ->with('success', 'Produto removido do carrinho!');

        } catch (\Exception $e) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Erro ao remover produto do carrinho!');
        }
    }

    public function atualizar(Request $request, $produtoId)
    {
        try {
            // CORRIGIDO: Alterado de 'auth' para 'user'
            if (!Session::get('user')) {
                return redirect()->route('login')
                    ->with('error', 'Sessão expirada. Faça login novamente.');
            }

            $request->validate([
                'quantidade' => 'required|integer|min:1'
            ]);

            $carrinho = Session::get('carrinho', []);
            $quantidade = intval($request->input('quantidade', 1));

            if (!isset($carrinho[$produtoId])) {
                return redirect()->route('carrinho.index')
                    ->with('error', 'Produto não encontrado no carrinho!');
            }

            if ($quantidade <= 0) {
                return redirect()->route('carrinho.index')
                    ->with('error', 'Quantidade deve ser maior que zero!');
            }

            $carrinho[$produtoId]['quantidade'] = $quantidade;
            Session::put('carrinho', $carrinho);

            return redirect()->route('carrinho.index')
                ->with('success', 'Quantidade atualizada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Erro ao atualizar quantidade!');
        }
    }

    public function limpar()
    {
        try {
            // CORRIGIDO: Alterado de 'auth' para 'user'
            if (!Session::get('user')) {
                return redirect()->route('login')
                    ->with('error', 'Sessão expirada. Faça login novamente.');
            }

            Session::forget('carrinho');

            return redirect()->route('carrinho.index')
                ->with('success', 'Carrinho limpo com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Erro ao limpar carrinho!');
        }
    }

    public function quantidade()
    {
        try {
            // CORRIGIDO: Alterado de 'auth' para 'user'
            if (!Session::get('user')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não autenticado',
                    'quantidade_total' => 0,
                    'quantidade_itens' => 0
                ], 401);
            }

            $carrinho = Session::get('carrinho', []);
            $quantidadeTotal = 0;
            $quantidadeItens = count($carrinho);

            foreach ($carrinho as $item) {
                $quantidadeTotal += $item['quantidade'];
            }

            return response()->json([
                'success' => true,
                'quantidade_total' => $quantidadeTotal,
                'quantidade_itens' => $quantidadeItens
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao obter quantidade',
                'quantidade_total' => 0,
                'quantidade_itens' => 0
            ], 500);
        }
    }

    private function calculateTotal($carrinho)
    {
        $total = 0;
        foreach ($carrinho as $item) {
            if (isset($item['preco']) && isset($item['quantidade'])) {
                $total += $item['preco'] * $item['quantidade'];
            }
        }
        return round($total, 2);
    }
}