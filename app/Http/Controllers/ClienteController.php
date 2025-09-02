<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private function requireAuth()
    {
        if (!session('auth')) {
            return redirect()->route('admin.login')
                ->with('warning', 'Faça login para acessar clientes.');
        }
        return null;
    }

    private function clientes()
    {
        return [
            ['id' => 1, 'nome' => 'ACME LTDA', 'email' => 'contato@acme.com', 'telefone' => '(11) 99999-0001'],
            ['id' => 2, 'nome' => 'TechSoft', 'email' => 'suporte@techsoft.com', 'telefone' => '(21) 98888-0002'],
            ['id' => 3, 'nome' => 'Mercado XYZ', 'email' => 'vendas@xyz.com', 'telefone' => '(31) 97777-0003'],
        ];
    }

    public function index()
    {
        if ($redirect = $this->requireAuth()) { return $redirect; }

        $clientes = $this->clientes();
        return view('pages.admin.index', compact('clientes'));
    }

    public function show($id)
    {
        if ($redirect = $this->requireAuth()) { return $redirect; }

        $cliente = collect($this->clientes())->firstWhere('id', (int)$id);

        if (!$cliente) {
            return redirect()->route('admin.clientes.index')->with('warning', 'Cliente não encontrado.');
        }

        // Preparar dados para a view de detalhes
        $registro = [
            'id' => $cliente['id'],
            'titulo' => $cliente['nome'],
            'descricao' => "Email: {$cliente['email']} | Telefone: {$cliente['telefone']}",
            'criado_em' => now()->format('d/m/Y H:i'),
            'status' => 'Ativo',
        ];

        return view('pages.admin.show', compact('registro'));
    }
}