<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Cliente;
use App\Models\Produto;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Você precisa fazer login para finalizar a compra.');
        }

        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
        }

        $estoqueInsuficiente = $this->verificarEstoque($carrinho);
        if (!empty($estoqueInsuficiente)) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Alguns produtos não têm estoque suficiente: ' . implode(', ', $estoqueInsuficiente));
        }

        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        $frete = session()->get('frete', 15.90);
        $desconto = session()->get('desconto', 0);
        $cupomAplicado = session()->get('cupom_aplicado', null);
        $total = $subtotal + $frete - $desconto;

        $user = Session::get('user');

        return view('pages.produtos.checkout', compact('carrinho', 'subtotal', 'frete', 'desconto', 'total', 'user', 'cupomAplicado'));
    }

    private function verificarEstoque($carrinho)
    {
        $semEstoque = [];

        foreach ($carrinho as $itemId => $item) {

            $produto = Produto::find($itemId);

            if (!$produto) {
                $semEstoque[] = "Produto {$item['nome']} não encontrado";
                continue;
            }

            $estoque = 100;

            if ($item['quantidade'] > $estoque) {
                $semEstoque[] = "{$item['nome']} (estoque: {$estoque}, solicitado: {$item['quantidade']})";
            }
        }

        return $semEstoque;
    }

    public function processarPedido(Request $request)
    {
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Sessão expirada. Faça login novamente.');
        }

        $user = Session::get('user');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'telefone' => 'required',
            'nome_completo' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:9',
            'bairro' => 'required|string|max:100',
            'metodo_pagamento' => 'required|string|in:cartao,boleto,transferencia,pix',
            'numero_cartao' => 'required_if:metodo_pagamento,cartao',
            'nome_cartao' => 'required_if:metodo_pagamento,cartao',
            'validade_cartao' => 'required_if:metodo_pagamento,cartao',
            'cvv_cartao' => 'required_if:metodo_pagamento,cartao',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O email informado não é válido.',
            'required_if' => 'O campo :attribute é obrigatório para pagamento com cartão.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor, corrija os erros no formulário.');
        }

        $carrinho = session()->get('carrinho', []);
        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
        }

        $estoqueInsuficiente = $this->verificarEstoque($carrinho);
        if (!empty($estoqueInsuficiente)) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Alguns produtos não têm estoque suficiente: ' . implode(', ', $estoqueInsuficiente));
        }

        try {
            Log::info('Iniciando processamento do pedido para: ' . $request->email);

            $subtotal = 0;
            foreach ($carrinho as $item) {
                $subtotal += $item['preco'] * $item['quantidade'];
            }

            $frete = session()->get('frete', 15.90);
            $desconto = session()->get('desconto', 0);
            $cupomAplicado = session()->get('cupom_aplicado', null);
            $total = $subtotal + $frete - $desconto;

            $numeroPedido = 'PED' . date('YmdHis') . rand(100, 999);

            $pedido = [
                'numero' => $numeroPedido,
                'cliente' => [
                    'nome' => $request->nome_completo,
                    'email' => $user['email'],
                    'telefone' => $request->telefone,
                    'endereco' => $request->endereco,
                    'cidade' => $request->cidade,
                    'estado' => $request->estado,
                    'cep' => $request->cep,
                    'bairro' => $request->bairro,
                ],
                'itens' => $carrinho,
                'subtotal' => $subtotal,
                'frete' => $frete,
                'desconto' => $desconto,
                'cupom_aplicado' => $cupomAplicado,
                'total' => $total,
                'metodo_pagamento' => $request->metodo_pagamento,
                'data' => now()->format('d/m/Y H:i:s'),
                'status' => $request->metodo_pagamento === 'pix' ? 'aguardando_pagamento' : 'confirmado'
            ];

            $pedidos = Session::get('pedidos', []);
            $pedidos[$numeroPedido] = $pedido;
            Session::put('pedidos', $pedidos);

            $this->salvarPedidoArquivo($pedido);

            session()->forget('carrinho');
            session()->forget('frete');
            session()->forget('desconto');
            session()->forget('cupom_aplicado');
            Session::put('carrinho_count', 0);

            Session::put('pedido_finalizado', true);

            if ($request->metodo_pagamento === 'pix') {
                $qrCodeUrl = $this->gerarQrCodePix($numeroPedido, $total);
                $pixCode = $this->gerarCodigoPix($numeroPedido, $total);

                return view('pages.produtos.confirmacao', compact('pedido', 'user', 'qrCodeUrl', 'pixCode'))
                    ->with('success', 'Pedido realizado com sucesso! Aguardando pagamento PIX.');
            }

            return redirect()->route('sucesso')
                ->with('success', 'Pedido realizado com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao processar pedido: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Erro ao processar pedido. Tente novamente.')
                ->withInput();
        }
    }

    private function salvarPedidoArquivo($pedido)
    {
        try {
            $pedidosFile = 'pedidos.json';
            $pedidosExistentes = [];

            if (Storage::exists($pedidosFile)) {
                $content = Storage::get($pedidosFile);
                if (!empty($content)) {
                    $pedidosExistentes = json_decode($content, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        Log::warning('JSON corrompido em pedidos.json, recriando arquivo');
                        $pedidosExistentes = [];
                    }
                }
            }

            $pedidosExistentes[$pedido['numero']] = $pedido;
            Storage::put($pedidosFile, json_encode($pedidosExistentes, JSON_PRETTY_PRINT));

            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao salvar pedido no arquivo: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Carrega pedidos do arquivo JSON
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
                Log::warning('JSON corrompido ou inválido em pedidos.json');
                return [];
            }

            return $pedidos;
        } catch (\Exception $e) {
            Log::error('Erro ao carregar pedidos do arquivo: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Exibe a página de confirmação de pedido com opção de pagamento PIX
     */
    public function confirmacao($id)
    {
        $user = Session::get('user');

        // Buscar pedido na sessão e no arquivo
        $pedidosSessao = Session::get('pedidos', []);
        $pedidosArquivo = $this->carregarPedidosArquivo();
        $pedidos = array_merge($pedidosSessao, $pedidosArquivo);

        if (!isset($pedidos[$id])) {
            return redirect()->route('home')->with('error', 'Pedido não encontrado!');
        }

        $pedido = $pedidos[$id];

        // Se o método de pagamento for PIX e ainda estiver aguardando, gerar QR Code
        if ($pedido['metodo_pagamento'] === 'pix' && $pedido['status'] === 'aguardando_pagamento') {
            $qrCodeUrl = $this->gerarQrCodePix($pedido['numero'], $pedido['total']);
            $pixCode = $this->gerarCodigoPix($pedido['numero'], $pedido['total']);
            return view('pages.produtos.confirmacao', compact('pedido', 'user', 'qrCodeUrl', 'pixCode'));
        }

        return view('pages.produtos.confirmacao', compact('pedido', 'user'));
    }

    /**
     * Gera um QR Code PIX fake usando API de placeholder
     */
    private function gerarQrCodePix($numeroPedido, $valor)
    {
        $valorFormatado = number_format($valor, 2, '', '');
        $textoQrCode = "00020126580014BR.GOV.BCB.PIX0136cobranca{$valorFormatado}{$numeroPedido}5204000053039865406{$valorFormatado}5802BR5901{$numeroPedido}6008Sao Paulo62070503***6304";
        return "https://api.qrserver.com/v1/create-qr-code/?size=256x256&data=" . urlencode($textoQrCode);
    }

    /**
     * Gera um código PIX fake (copiável)
     */
    private function gerarCodigoPix($numeroPedido, $valor)
    {
        $valorFormatado = number_format($valor, 2, '', '');
        return "00020126580014BR.GOV.BCB.PIX0136cobranca{$valorFormatado}{$numeroPedido}5204000053039865406{$valorFormatado}5802BR5901{$numeroPedido}6008Sao Paulo62070503***6304" . strtoupper(substr(md5($numeroPedido), 0, 4));
    }

    /**
     * Atualiza o status do pagamento (para simulação)
     */
    public function atualizarStatusPagamento($id)
    {
        $pedidos = Session::get('pedidos', []);

        if (isset($pedidos[$id])) {
            $pedidos[$id]['status'] = 'confirmado';
            $pedidos[$id]['data_pagamento'] = now()->format('d/m/Y H:i:s');
            Session::put('pedidos', $pedidos);
            $this->salvarPedidoArquivo($pedidos[$id]);

            return response()->json([
                'success' => true,
                'status' => 'confirmado',
                'message' => 'Pagamento confirmado com sucesso!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Pedido não encontrado!'
        ], 404);
    }

    /**
     * Aplica cupom de desconto
     */
    public function aplicarCupom(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_cupom' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Código do cupom é obrigatório.'
            ]);
        }

        $cupomValido = $this->validarCupom($request->codigo_cupom);
        if (!$cupomValido) {
            return response()->json([
                'success' => false,
                'message' => 'Cupom inválido ou expirado.'
            ]);
        }

        $desconto = $this->calcularDescontoCupom($request->codigo_cupom);
        session()->put('desconto', $desconto);
        session()->put('cupom_aplicado', $request->codigo_cupom);

        // Recalcular totais
        $carrinho = session()->get('carrinho', []);
        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        $frete = session()->get('frete', 15.90);
        if (strtoupper($request->codigo_cupom) === 'FRETEGRATIS') {
            $frete = 0.00;
            session()->put('frete', $frete);
        }

        $total = $subtotal + $frete - $desconto;

        return response()->json([
            'success' => true,
            'desconto' => $desconto,
            'cupom_codigo' => $request->codigo_cupom,
            'subtotal' => number_format($subtotal, 2, ',', '.'),
            'frete' => number_format($frete, 2, ',', '.'),
            'total' => number_format($total, 2, ',', '.'),
            'message' => 'Cupom aplicado com sucesso!'
        ]);
    }

    /**
     * Remove cupom de desconto
     */
    public function removerCupom()
    {
        $cupomAplicado = session()->get('cupom_aplicado');
        if (!$cupomAplicado) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum cupom aplicado para remover.'
            ]);
        }

        session()->forget('desconto');
        session()->forget('cupom_aplicado');

        $carrinho = session()->get('carrinho', []);
        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        $frete = session()->get('frete', 15.90);
        $total = $subtotal + $frete;

        return response()->json([
            'success' => true,
            'subtotal' => number_format($subtotal, 2, ',', '.'),
            'frete' => number_format($frete, 2, ',', '.'),
            'total' => number_format($total, 2, ',', '.'),
            'message' => 'Cupom removido com sucesso!'
        ]);
    }

    /**
     * Valida um cupom de desconto (simulação)
     */
    private function validarCupom($codigo)
    {
        $cuponsValidos = [
            'DESCONTO10' => 10.00,
            'PROMO20' => 20.00,
            'FRETEGRATIS' => 'frete_gratis',
            'BLACKFRIDAY' => 50.00,
            'SUPER10' => 10.00
        ];
        return array_key_exists(strtoupper($codigo), $cuponsValidos);
    }

    /**
     * Calcula o valor do desconto baseado no cupom
     */
    private function calcularDescontoCupom($codigo)
    {
        $cupons = [
            'DESCONTO10' => 10.00,
            'PROMO20' => 20.00,
            'FRETEGRATIS' => 0.00,
            'BLACKFRIDAY' => 50.00,
            'SUPER10' => 10.00
        ];
        return $cupons[strtoupper($codigo)] ?? 0.00;
    }

    /**
     * Calcula frete baseado no CEP
     */
    public function calcularFrete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cep' => 'required|string|max:9'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'CEP inválido.']);
        }

        $cep = preg_replace('/[^0-9]/', '', $request->cep);
        $frete = 15.90; // Valor padrão

        // Lógica simples de cálculo de frete
        if (strpos($cep, '01000') === 0) {
            $frete = 12.90;
        } elseif (strpos($cep, '10000') === 0) {
            $frete = 18.90;
        }

        // Verificar se há cupom de frete grátis
        $cupomAplicado = session()->get('cupom_aplicado');
        if ($cupomAplicado && strtoupper($cupomAplicado) === 'FRETEGRATIS') {
            $frete = 0.00;
        }

        session()->put('frete', $frete);

        // Recalcular totais
        $carrinho = session()->get('carrinho', []);
        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        $desconto = session()->get('desconto', 0);
        $total = $subtotal + $frete - $desconto;

        return response()->json([
            'success' => true,
            'frete' => $frete,
            'subtotal' => number_format($subtotal, 2, ',', '.'),
            'desconto' => number_format($desconto, 2, ',', '.'),
            'total' => number_format($total, 2, ',', '.'),
            'message' => 'Frete calculado com sucesso!'
        ]);
    }

    /**
     * Lista de pedidos do usuário
     */
    public function meusPedidos()
    {
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Faça login para visualizar suas compras.');
        }

        $user = Session::get('user');
        $pedidosSessao = Session::get('pedidos', []);
        $pedidosArquivo = $this->carregarPedidosArquivo();
        $todosPedidos = array_merge($pedidosSessao, $pedidosArquivo);

        // Filtrar pedidos por email do usuário
        $minhasCompras = [];
        foreach ($todosPedidos as $pedido) {
            if (isset($pedido['cliente']['email']) && $pedido['cliente']['email'] === $user['email']) {
                $minhasCompras[] = $pedido;
            }
        }

        // Ordenar por data (mais recente primeiro)
        usort($minhasCompras, function ($a, $b) {
            $dataA = isset($a['data']) ? strtotime(str_replace('/', '-', $a['data'])) : 0;
            $dataB = isset($b['data']) ? strtotime(str_replace('/', '-', $b['data'])) : 0;
            return $dataB - $dataA;
        });

        return view('pages.produtos.minhascompras', [
            'minhasCompras' => $minhasCompras,
            'user' => $user
        ]);
    }

    /**
     * Detalhes de um pedido específico
     */
    public function detalhesPedido($id)
    {
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Faça login para visualizar seus pedidos.');
        }

        $user = Session::get('user');
        $pedidosSessao = Session::get('pedidos', []);
        $pedidosArquivo = $this->carregarPedidosArquivo();
        $todosPedidos = array_merge($pedidosSessao, $pedidosArquivo);

        if (!isset($todosPedidos[$id])) {
            return redirect()->route('minhas.compras')->with('error', 'Pedido não encontrado!');
        }

        $pedido = $todosPedidos[$id];

        // Verificar se o pedido pertence ao usuário
        if (!isset($pedido['cliente']['email']) || $pedido['cliente']['email'] !== $user['email']) {
            return redirect()->route('minhas.compras')->with('error', 'Você não tem permissão para visualizar este pedido!');
        }

        return view('pages.produtos.detalhes-compra', compact('pedido', 'user'));
    }

    /**
     * Filtra pedidos por critérios específicos
     */
    public function filtrar(Request $request)
    {
        if (!Session::get('user')) {
            return response()->json(['success' => false, 'message' => 'Faça login para visualizar suas compras.'], 401);
        }

        $user = Session::get('user');
        $filtro = $request->input('filtro', 'recentes');

        $pedidosSessao = Session::get('pedidos', []);
        $pedidosArquivo = $this->carregarPedidosArquivo();
        $todosPedidos = array_merge($pedidosSessao, $pedidosArquivo);

        // Filtrar pedidos por email do usuário
        $minhasCompras = [];
        foreach ($todosPedidos as $pedido) {
            if (isset($pedido['cliente']['email']) && $pedido['cliente']['email'] === $user['email']) {
                $minhasCompras[] = $pedido;
            }
        }

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