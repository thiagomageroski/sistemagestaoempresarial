<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function requireAuth()
    {
        if (!session('auth')) {
            return redirect()->route('admin.login')
                ->with('warning', 'Faça login para acessar o painel.');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->requireAuth()) { return $redirect; }

        $clientes = [
            ['id' => 1, 'nome' => 'ACME LTDA', 'email' => 'contato@acme.com'],
            ['id' => 2, 'nome' => 'TechSoft', 'email' => 'suporte@techsoft.com'],
            ['id' => 3, 'nome' => 'Mercado XYZ', 'email' => 'vendas@xyz.com'],
        ];

        return view('pages.admin.index', compact('clientes'));
    }

    public function dashboard()
    {
        if ($redirect = $this->requireAuth()) { return $redirect; }

        // Dados para o dashboard
        $metricas = [
            'faturamento_mes' => 125000.75,
            'pedidos_abertos' => 37,
            'clientes_novos'  => 12,
            'estoque_baixo'   => 5,
        ];

        $vendasUltimosDias = [
            ['dia' => 'Seg', 'valor' => 12000],
            ['dia' => 'Ter', 'valor' => 15000],
            ['dia' => 'Qua', 'valor' => 11000],
            ['dia' => 'Qui', 'valor' => 17000],
            ['dia' => 'Sex', 'valor' => 22000],
            ['dia' => 'Sáb', 'valor' => 8000],
            ['dia' => 'Dom', 'valor' => 6000],
        ];

        return view('pages.admin.dashboard', compact('metricas', 'vendasUltimosDias'));
    }

    public function show($id)
    {
        if ($redirect = $this->requireAuth()) { return $redirect; }

        $registro = [
            'id' => $id,
            'titulo' => "Registro #{$id}",
            'descricao' => 'Este é um exemplo de detalhe dentro do módulo administrativo.',
            'criado_em' => now()->format('d/m/Y H:i'),
            'status' => 'Ativo',
        ];

        return view('pages.admin.show', compact('registro'));
    }

    public function metricas()
    {
        if ($redirect = $this->requireAuth()) { return $redirect; }

        return response()->json([
            'faturamento_mes' => 125000.75,
            'pedidos_abertos' => 37,
            'clientes_novos'  => 12,
            'estoque_baixo'   => 5,
        ]);
    }

    public function vendasRecentes()
    {
        if ($redirect = $this->requireAuth()) { return $redirect; }

        return response()->json([
            ['dia' => 'Seg', 'valor' => 12000],
            ['dia' => 'Ter', 'valor' => 15000],
            ['dia' => 'Qua', 'valor' => 11000],
            ['dia' => 'Qui', 'valor' => 17000],
            ['dia' => 'Sex', 'valor' => 22000],
            ['dia' => 'Sáb', 'valor' => 8000],
            ['dia' => 'Dom', 'valor' => 6000],
        ]);
    }
}