<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        // busca o produto no banco de dados
        $produtos = Produto::all();
        
        $usuario = Session::get('user');
        
        $destaques = Produto::take(3)->get();

        $categorias = ['Eletrônicos', 'Roupas', 'Casa'];

        return view('pages.produtos.index', compact('produtos', 'usuario', 'destaques', 'categorias'));
    }

    public function show($id)
    {
        // busca o produto no banco de dados
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()
                ->route('produtos.index')
                ->with('warning', 'Produto não encontrado.');
        }

        $relacionados = Produto::where('id', '!=', $id)
                              ->take(3)
                              ->get();

        $usuario = Session::get('user');

        return view('pages.produtos.show', compact('produto', 'relacionados', 'usuario'));
    }

    public function porCategoria($categoria)
    {
        $produtosFiltrados = Produto::all();

        $usuario = Session::get('user');
        
        $categorias = ['Eletrônicos', 'Roupas', 'Casa'];

        return view('pages.produtos.categoria', compact('produtosFiltrados', 'categoria', 'usuario', 'categorias'));
    }

    public function destaque()
    {
        $destaques = Produto::all();

        $usuario = Session::get('user');
        
        $categorias = ['Eletrônicos', 'Roupas', 'Casa'];

        return view('pages.produtos.destaque', compact('destaques', 'usuario', 'categorias'));
    }
}