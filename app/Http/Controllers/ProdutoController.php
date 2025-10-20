<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProdutoController extends Controller
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

    public function index()
    {
        $produtos = $this->produtos();
        
        $usuario = Session::get('user');
        
        $destaques = collect($produtos)->where('destaque', true)->take(3)->values()->all();
        
        $categorias = collect($produtos)->pluck('categoria')->unique()->values()->all();

        return view('pages.produtos.index', compact('produtos', 'usuario', 'destaques', 'categorias'));
    }

    public function show($slug)
    {
        $produto = collect($this->produtos())->firstWhere('slug', $slug);

        if (!$produto) {
            return redirect()
                ->route('produtos.index')
                ->with('warning', 'Produto não encontrado.');
        }

        $relacionados = collect($this->produtos())
            ->reject(fn($p) => $p['slug'] === $slug)
            ->where('categoria', $produto['categoria'])
            ->take(3)
            ->values()
            ->all();

        if (count($relacionados) < 3) {
            $complemento = collect($this->produtos())
                ->reject(fn($p) => $p['slug'] === $slug || in_array($p, $relacionados))
                ->take(3 - count($relacionados))
                ->values()
                ->all();
            
            $relacionados = array_merge($relacionados, $complemento);
        }

        $usuario = Session::get('user');

        return view('pages.produtos.show', compact('produto', 'relacionados', 'usuario'));
    }

    public function porCategoria($categoria)
    {
        $produtosFiltrados = collect($this->produtos())
            ->where('categoria', $categoria)
            ->values()
            ->all();

        if (empty($produtosFiltrados)) {
            return redirect()
                ->route('produtos.index')
                ->with('warning', 'Nenhum produto encontrado para esta categoria.');
        }

        $usuario = Session::get('user');
        $categorias = collect($this->produtos())->pluck('categoria')->unique()->values()->all();

        return view('pages.produtos.categoria', compact('produtosFiltrados', 'categoria', 'usuario', 'categorias'));
    }

    public function destaque()
    {
        $destaques = collect($this->produtos())
            ->where('destaque', true)
            ->values()
            ->all();

        $usuario = Session::get('user');
        $categorias = collect($this->produtos())->pluck('categoria')->unique()->values()->all();

        return view('pages.produtos.destaque', compact('destaques', 'usuario', 'categorias'));
    }

    public function adminIndex()
    {
        $produtos = $this->produtos();
        return view('pages.admin.dashboard', compact('produtos'));
    }
}