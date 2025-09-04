<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function cadastro()
    {
        // A verificação será feita pelo middleware CheckAuth
        return view('pages.cadastro');
    }

    public function login()
    {
        // A verificação será feita pelo middleware CheckAuth
        return view('pages.login');
    }
}