<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private function produtos()
    {
        return [
            [
                'slug' => 'notebook-pro-15',
                'nome' => 'Notebook Pro 15',
                'preco' => 7999.90,
                'categoria' => 'Informática',
                'descricao' => 'Notebook profissional com 16GB RAM, SSD 512GB. Processador Intel i7, placa de vídeo dedicada.',
                'imagem' => 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            ],
            [
                'slug' => 'mouse-ergonomico',
                'nome' => 'Mouse Ergonômico',
                'preco' => 199.90,
                'categoria' => 'Acessórios',
                'descricao' => 'Mouse ergonômico com design confortável para longas horas de uso. Conexão wireless.',
                'imagem' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            ],
            [
                'slug' => 'monitor-27-4k',
                'nome' => 'Monitor 27" 4K',
                'preco' => 2499.90,
                'categoria' => 'Periféricos',
                'descricao' => 'Monitor 4K UHD de 27 polegadas com taxa de atualização de 144Hz. Perfect para designers.',
                'imagem' => 'https://images.unsplash.com/photo-1546538915-a9e2c8d0a5df?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            ],
            [
                'slug' => 'teclado-mecanico',
                'nome' => 'Teclado Mecânico RGB',
                'preco' => 499.90,
                'categoria' => 'Acessórios',
                'descricao' => 'Teclado mecânico com switches Blue, iluminação RGB personalizável e construção em alumínio.',
                'imagem' => 'https://images.unsplash.com/photo-1541140532154-b024d705b90a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            ],
            [
                'slug' => 'headphone-bluetooth',
                'nome' => 'Headphone Bluetooth',
                'preco' => 349.90,
                'categoria' => 'Áudio',
                'descricao' => 'Headphone wireless com cancelamento de ruído ativo, bateria de 30 horas.',
                'imagem' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            ],
            [
                'slug' => 'webcam-4k',
                'nome' => 'Webcam 4K',
                'preco' => 399.90,
                'categoria' => 'Acessórios',
                'descricao' => 'Webcam 4K com microfone integrado e ajuste automático de foco.',
                'imagem' => 'https://images.unsplash.com/photo-1531297484001-80022131f5a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            ]
        ];
    }

    public function index()
    {
        $produtos = $this->produtos();
        return view('pages.produtos.index', compact('produtos'));
    }

    public function show($slug)
    {
        $produto = collect($this->produtos())->firstWhere('slug', $slug);

        if (!$produto) {
            return redirect()
                ->route('produtos.index')
                ->with('warning', 'Produto não encontrado.');
        }

        // Produtos relacionados
        $relacionados = collect($this->produtos())
            ->reject(fn($p) => $p['slug'] === $slug)
            ->take(3)
            ->values()
            ->all();

        return view('pages.produtos.show', compact('produto', 'relacionados'));
    }
}