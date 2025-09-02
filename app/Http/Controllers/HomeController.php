<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $features = [
            [
                'title' => 'Gestão Financeira', 
                'desc' => 'Controle completo do seu fluxo de caixa, relatórios detalhados e análise de desempenho financeiro.'
            ],
            [
                'title' => 'Controle de Estoque', 
                'desc' => 'Gerencie seu inventário com alertas automáticos, controle de entradas/saídas e integração com vendas.'
            ],
            [
                'title' => 'Vendas e PDV', 
                'desc' => 'Sistema completo de vendas com emissão de NFC-e, controle de comissões e gestão de clientes.'
            ]
        ];

        return view('pages.home', compact('features'));
    }

    public function sobre()
    {
        return view('pages.sobre');
    }

    public function cadastro(Request $request)
    {
        // Verifica se há uma mensagem de redirecionamento
        $error = $request->session()->get('error');
        
        return view('pages.cadastro', compact('error'));
    }
}