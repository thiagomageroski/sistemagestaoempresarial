<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    private function requireAuth()
    {
        // CORREÇÃO: Usar Session::get('user') em vez de session('auth')
        if (!Session::get('user')) {
            return redirect()->route('admin.login')
                ->with('warning', 'Faça login para acessar clientes.');
        }
        
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if ($user['role'] !== 'admin') {
            return redirect()->route('home')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem acessar esta área.');
        }
        
        return null;
    }

    private function clientes()
    {
        return [
            ['id' => 1, 'nome' => 'ACME LTDA', 'email' => 'contato@acme.com', 'telefone' => '(11) 99999-0001', 'status' => 'Ativo'],
            ['id' => 2, 'nome' => 'TechSoft', 'email' => 'suporte@techsoft.com', 'telefone' => '(21) 98888-0002', 'status' => 'Ativo'],
            ['id' => 3, 'nome' => 'Mercado XYZ', 'email' => 'vendas@xyz.com', 'telefone' => '(31) 97777-0003', 'status' => 'Inativo'],
            ['id' => 4, 'nome' => 'Comércio ABC', 'email' => 'contato@comercioabc.com', 'telefone' => '(41) 96666-0004', 'status' => 'Ativo'],
            ['id' => 5, 'nome' => 'Serviços Rápidos', 'email' => 'atendimento@servicosrapidos.com', 'telefone' => '(51) 95555-0005', 'status' => 'Pendente'],
        ];
    }

    public function index()
    {
        if ($redirect = $this->requireAuth()) { 
            return $redirect; 
        }

        $clientes = $this->clientes();
        return view('pages.admin.dashboard', compact('clientes'));
    }

    public function show($id)
    {
        if ($redirect = $this->requireAuth()) { 
            return $redirect; 
        }

        $cliente = collect($this->clientes())->firstWhere('id', (int)$id);

        if (!$cliente) {
            return redirect()->route('admin.clientes.index')->with('error', 'Cliente não encontrado.');
        }

        // Preparar dados para a view de detalhes
        $registro = [
            'id' => $cliente['id'],
            'titulo' => $cliente['nome'],
            'descricao' => "Email: {$cliente['email']} | Telefone: {$cliente['telefone']}",
            'criado_em' => now()->subDays(rand(1, 30))->format('d/m/Y H:i'),
            'status' => $cliente['status'],
            'detalhes' => [
                'Nome' => $cliente['nome'],
                'Email' => $cliente['email'],
                'Telefone' => $cliente['telefone'],
                'Status' => $cliente['status'],
                'Data de Cadastro' => now()->subDays(rand(1, 365))->format('d/m/Y'),
                'Última Atualização' => now()->subDays(rand(1, 30))->format('d/m/Y H:i'),
            ]
        ];

        return view('pages.admin.show', compact('registro'));
    }

    public function create()
    {
        if ($redirect = $this->requireAuth()) { 
            return $redirect; 
        }

        return view('pages.admin.clientes.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->requireAuth()) { 
            return $redirect; 
        }

        // Em um sistema real, aqui viria a validação e persistência dos dados
        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente criado com sucesso!');
    }

    public function edit($id)
    {
        if ($redirect = $this->requireAuth()) { 
            return $redirect; 
        }

        $cliente = collect($this->clientes())->firstWhere('id', (int)$id);

        if (!$cliente) {
            return redirect()->route('admin.clientes.index')->with('error', 'Cliente não encontrado.');
        }

        return view('pages.admin.clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->requireAuth()) { 
            return $redirect; 
        }

        // Em um sistema real, aqui viria a validação e atualização dos dados
        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if ($redirect = $this->requireAuth()) { 
            return $redirect; 
        }

        // Em um sistema real, aqui viria a exclusão do cliente
        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }
}