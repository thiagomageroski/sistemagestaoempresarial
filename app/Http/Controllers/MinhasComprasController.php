<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MinhasComprasController extends Controller
{
    /**
     * Exibe a página com todas as compras do usuário - CORRIGIDO
     */
    public function index()
    {
        // Verificar se o usuário está autenticado
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Faça login para visualizar suas compras.');
        }

        $user = Session::get('user');

        // Buscar todos os pedidos de forma consistente
        $todosPedidos = $this->carregarTodosPedidos();

        // Filtrar pedidos por email do usuário - CORREÇÃO IMPORTANTE
        $minhasCompras = array_filter($todosPedidos, function ($pedido) use ($user) {
            return is_array($pedido) && 
                   isset($pedido['cliente']['email']) && 
                   $pedido['cliente']['email'] === $user['email'];
        });

        // Ordenar por data (mais recente primeiro)
        usort($minhasCompras, function ($a, $b) {
            $dataA = isset($a['data']) ? strtotime(str_replace('/', '-', $a['data'])) : 0;
            $dataB = isset($b['data']) ? strtotime(str_replace('/', '-', $b['data'])) : 0;
            return $dataB - $dataA;
        });

        return view('pages.produtos.minhascompras', compact('minhasCompras', 'user'));
    }

    /**
     * Exibe os detalhes de uma compra específica - CORRIGIDO
     */
    public function show($id)
    {
        // Verificar se o usuário está autenticado
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Faça login para visualizar suas compras.');
        }

        $user = Session::get('user');

        // Buscar todos os pedidos
        $todosPedidos = $this->carregarTodosPedidos();

        if (!isset($todosPedidos[$id])) {
            return redirect()->route('minhas.compras')
                ->with('error', 'Compra não encontrada!');
        }

        $compra = $todosPedidos[$id];

        // Verificar se a compra pertence ao usuário
        if (!isset($compra['cliente']['email']) || $compra['cliente']['email'] !== $user['email']) {
            return redirect()->route('minhas.compras')
                ->with('error', 'Você não tem permissão para visualizar esta compra!');
        }

        return view('pages.produtos.detalhes-compra', compact('compra', 'user'));
    }

    /**
     * Carrega TODOS os pedidos de forma consistente (sessão + arquivo) - NOVO MÉTODO
     */
    private function carregarTodosPedidos()
    {
        $pedidosSessao = Session::get('pedidos', []);
        $pedidosArquivo = $this->carregarPedidosArquivo();
        
        // Garantir que ambos sejam arrays
        if (!is_array($pedidosSessao)) $pedidosSessao = [];
        if (!is_array($pedidosArquivo)) $pedidosArquivo = [];
        
        // Combinar pedidos, priorizando a sessão em caso de duplicatas
        return array_merge($pedidosArquivo, $pedidosSessao);
    }

    /**
     * Carrega pedidos do arquivo JSON - CORRIGIDO
     */
    private function carregarPedidosArquivo()
    {
        try {
            $pedidosFile = 'pedidos.json';
            $path = storage_path('app/' . $pedidosFile);

            if (!file_exists($path)) {
                return [];
            }

            $content = file_get_contents($path);
            
            if (empty(trim($content))) {
                return [];
            }

            $pedidos = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE || !is_array($pedidos)) {
                return [];
            }

            return $pedidos;

        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Cancela um pedido (se ainda estiver pendente) - CORRIGIDO
     */
    public function cancelar(Request $request, $id)
    {
        // Verificar se o usuário está autenticado
        if (!Session::get('user')) {
            return response()->json([
                'success' => false,
                'message' => 'Faça login para realizar esta ação.'
            ], 401);
        }

        $user = Session::get('user');

        // Buscar pedidos da sessão
        $pedidos = Session::get('pedidos', []);

        if (!isset($pedidos[$id])) {
            // Tentar buscar do arquivo
            $pedidosArquivo = $this->carregarPedidosArquivo();
            if (!isset($pedidosArquivo[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pedido não encontrado!'
                ], 404);
            }
            $pedido = $pedidosArquivo[$id];
        } else {
            $pedido = $pedidos[$id];
        }

        // Verificar se o pedido pertence ao usuário
        if (!isset($pedido['cliente']['email']) || $pedido['cliente']['email'] !== $user['email']) {
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para cancelar este pedido!'
            ], 403);
        }

        // Verificar se o pedido pode ser cancelado
        if (!in_array($pedido['status'], ['aguardando_pagamento', 'confirmado'])) {
            return response()->json([
                'success' => false,
                'message' => 'Este pedido não pode ser cancelado.'
            ], 400);
        }

        // Atualizar o pedido na sessão
        if (isset($pedidos[$id])) {
            $pedidos[$id]['status'] = 'cancelado';
            $pedidos[$id]['data_cancelamento'] = now()->format('d/m/Y H:i:s');
            Session::put('pedidos', $pedidos);
        }

        // Atualizar também no arquivo
        $this->atualizarPedidoArquivo($id, [
            'status' => 'cancelado',
            'data_cancelamento' => now()->format('d/m/Y H:i:s')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pedido cancelado com sucesso!'
        ]);
    }

    /**
     * Atualiza um pedido no arquivo - NOVO MÉTODO
     */
    private function atualizarPedidoArquivo($id, $dadosAtualizados)
    {
        try {
            $pedidos = $this->carregarPedidosArquivo();
            
            if (isset($pedidos[$id])) {
                $pedidos[$id] = array_merge($pedidos[$id], $dadosAtualizados);
                
                $pedidosFile = 'pedidos.json';
                file_put_contents(storage_path('app/' . $pedidosFile), json_encode($pedidos, JSON_PRETTY_PRINT));
                
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Reordenar pedidos por filtro - CORRIGIDO
     */
    public function filtrar(Request $request)
    {
        // Verificar se o usuário está autenticado
        if (!Session::get('user')) {
            return response()->json([
                'success' => false,
                'message' => 'Faça login para visualizar suas compras.'
            ], 401);
        }

        $user = Session::get('user');
        $filtro = $request->input('filtro', 'recentes');

        // Buscar todos os pedidos
        $todosPedidos = $this->carregarTodosPedidos();

        // Filtrar pedidos por email do usuário
        $minhasCompras = array_filter($todosPedidos, function ($pedido) use ($user) {
            return is_array($pedido) && 
                   isset($pedido['cliente']['email']) && 
                   $pedido['cliente']['email'] === $user['email'];
        });

        // Aplicar filtro
        switch ($filtro) {
            case 'recentes':
                usort($minhasCompras, function ($a, $b) {
                    $dataA = isset($a['data']) ? strtotime(str_replace('/', '-', $a['data'])) : 0;
                    $dataB = isset($b['data']) ? strtotime(str_replace('/', '-', $b['data'])) : 0;
                    return $dataB - $dataA;
                });
                break;

            case 'antigos':
                usort($minhasCompras, function ($a, $b) {
                    $dataA = isset($a['data']) ? strtotime(str_replace('/', '-', $a['data'])) : 0;
                    $dataB = isset($b['data']) ? strtotime(str_replace('/', '-', $b['data'])) : 0;
                    return $dataA - $dataB;
                });
                break;

            case 'valor_maior':
                usort($minhasCompras, function ($a, $b) {
                    return ($b['total'] ?? 0) - ($a['total'] ?? 0);
                });
                break;

            case 'valor_menor':
                usort($minhasCompras, function ($a, $b) {
                    return ($a['total'] ?? 0) - ($b['total'] ?? 0);
                });
                break;
        }

        return response()->json([
            'success' => true,
            'compras' => array_values($minhasCompras)
        ]);
    }
}