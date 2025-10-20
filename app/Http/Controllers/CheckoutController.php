<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Cliente;

class CheckoutController extends Controller
{

    public function index()
    {
        // Verificar se o usuário está autenticado (usando SESSION)
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Você precisa fazer login para finalizar a compra.');
        }

        // Obter o carrinho da sessão
        $carrinho = session()->get('carrinho', []);

        // Verificar se o carrinho está vazio
        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
        }

        // Verificar estoque antes de prosseguir para checkout
        $estoqueInsuficiente = $this->verificarEstoque($carrinho);
        if (!empty($estoqueInsuficiente)) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Alguns produtos não têm estoque suficiente: ' . implode(', ', $estoqueInsuficiente));
        }

        // Calcular totais
        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        $frete = session()->get('frete', 15.90);
        $desconto = session()->get('desconto', 0);
        $cupomAplicado = session()->get('cupom_aplicado', null);
        $total = $subtotal + $frete - $desconto;

        // Obter dados do usuário da sessão
        $user = Session::get('user');

        return view('pages.produtos.checkout', compact('carrinho', 'subtotal', 'frete', 'desconto', 'total', 'user', 'cupomAplicado'));
    }

    /**
     * Verifica se há estoque suficiente para todos os itens do carrinho
     */
    private function verificarEstoque($carrinho)
    {
        $produtos = $this->getProdutos();
        $semEstoque = [];

        foreach ($carrinho as $itemId => $item) {
            $produto = collect($produtos)->firstWhere('id', $itemId);

            if (!$produto) {
                $semEstoque[] = "Produto ID {$itemId} não encontrado";
                continue;
            }

            if ($item['quantidade'] > $produto['estoque']) {
                $semEstoque[] = "{$item['nome']} (estoque: {$produto['estoque']}, solicitado: {$item['quantidade']})";
            }
        }

        return $semEstoque;
    }

    /**
     * Obtém a lista de produtos
     */
    private function getProdutos()
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

    /**
     * Processa o pedido (sem banco de dados)
     */
    public function processarPedido(Request $request)
    {
        // Verificar autenticação primeiro
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Sessão expirada. Faça login novamente.');
        }

        $user = Session::get('user');

        // Validar dados do formulário
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

        // Verificar se o carrinho existe e não está vazio
        $carrinho = session()->get('carrinho', []);
        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
        }

        // Verificar estoque novamente antes de finalizar
        $estoqueInsuficiente = $this->verificarEstoque($carrinho);
        if (!empty($estoqueInsuficiente)) {
            return redirect()->route('carrinho.index')
                ->with('error', 'Alguns produtos não têm estoque suficiente: ' . implode(', ', $estoqueInsuficiente));
        }

        try {
            Log::info('Iniciando processamento do pedido para: ' . $request->email);

            $cliente = Cliente::where('email', $user['email'])->first();

            if ($cliente) {
                $cliente->update([
                    'cep' => $request->cep,
                    'logradouro' => $request->endereco,
                    'bairro' => $request->bairro,
                    'cidade' => $request->cidade,
                    'uf' => $request->estado
                ]);
            }

            // Calcular totais
            $subtotal = 0;
            foreach ($carrinho as $item) {
                $subtotal += $item['preco'] * $item['quantidade'];
            }

            $frete = session()->get('frete', 15.90);
            $desconto = session()->get('desconto', 0);
            $cupomAplicado = session()->get('cupom_aplicado', null);
            $total = $subtotal + $frete - $desconto;

            // Criar número do pedido (simulado)
            $numeroPedido = 'PED' . date('YmdHis') . rand(100, 999);

            // DEBUG: Log do número do pedido
            Log::info('Número do pedido gerado: ' . $numeroPedido);

            // Salvar dados do pedido na sessão
            $pedido = [
                'numero' => $numeroPedido,
                'cliente' => [
                    'nome' => $request->nome_completo,
                    'email' => $request->email,
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

            // DEBUG: Log do pedido criado
            Log::info('Pedido criado: ', $pedido);

            // Salvar pedido na sessão
            $pedidos = Session::get('pedidos', []);
            $pedidos[$numeroPedido] = $pedido;
            Session::put('pedidos', $pedidos);

            // GARANTIR que o pedido é salvo com o email correto do usuário logado
            if (!isset($pedidos[$numeroPedido]['cliente']['email'])) {
                $pedidos[$numeroPedido]['cliente']['email'] = $user['email'];
                Session::put('pedidos', $pedidos);
            }

            // Também salvar em arquivo para persistência
            $salvo = $this->salvarPedidoArquivo($pedidos[$numeroPedido]);

            if (!$salvo) {
                Log::error('Falha ao salvar pedido no arquivo: ' . $numeroPedido);
                // Continuar mesmo dengan falha no arquivo, pois temos na sessão
            }

            // Limpar carrinho, frete e desconto
            session()->forget('carrinho');
            session()->forget('frete');
            session()->forget('desconto');
            session()->forget('cupom_aplicado');
            Session::put('carrinho_count', 0);

            // MARCA QUE O USUÁRIO FINALIZOU UM PEDIDO COM SUCESSO
            Session::put('pedido_finalizado', true);
            Log::info('Pedido finalizado marcado na sessão para usuário: ' . $user['email']);

            // DEBUG: Log de sucesso
            Log::info('Pedido processado com sucesso: ' . $numeroPedido);

            // Se for PIX, redirecionar para a página de confirmação com QR Code
            if ($request->metodo_pagamento === 'pix') {
                $qrCodeUrl = $this->gerarQrCodePix($numeroPedido, $total);
                $pixCode = $this->gerarCodigoPix($numeroPedido, $total);

                return view('pages.produtos.confirmacao', compact('pedido', 'user', 'qrCodeUrl', 'pixCode'))
                    ->with('success', 'Pedido realizado com sucesso! Aguardando pagamento PIX.');
            }

            // Se não for PIX, redirecionar para a página de sucesso
            return redirect()->route('sucesso')
                ->with('success', 'Pedido realizado com sucesso!');

        } catch (\Exception $e) {
            // DEBUG: Log do erro completo
            Log::error('Erro ao processar pedido: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Erro ao processar pedido. Tente novamente.')
                ->withInput();
        }
    }

    /**
     * Salva o pedido em arquivo JSON para persistência
     */
    private function salvarPedidoArquivo($pedido)
    {
        try {
            $pedidosFile = 'pedidos.json';
            $pedidosExistentes = [];

            // Verificar se o diretório de storage existe e tem permissões
            if (!Storage::exists('')) {
                Storage::makeDirectory('');
            }

            if (Storage::exists($pedidosFile)) {
                $content = Storage::get($pedidosFile);
                // Verificar se o JSON é válido
                if (!empty($content)) {
                    $pedidosExistentes = json_decode($content, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        Log::warning('JSON corrompido em pedidos.json, recriando arquivo');
                        $pedidosExistentes = [];
                    }
                }
            }

            $pedidosExistentes[$pedido['numero']] = $pedido;

            // Tentar salvar o arquivo
            $saved = Storage::put($pedidosFile, json_encode($pedidosExistentes, JSON_PRETTY_PRINT));

            if (!$saved) {
                Log::error('Falha ao escrever no arquivo pedidos.json');
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao salvar pedido no arquivo: ' . $e->getMessage());
            return false;
        }
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

            // Verificar se o conteúdo está vazio
            if (empty(trim($content))) {
                return [];
            }

            $pedidos = json_decode($content, true);

            // Verificar se o JSON foi decodificado corretamente e é um array
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

        // Garantir que ambos sejam arrays
        if (!is_array($pedidosSessao))
            $pedidosSessao = [];
        if (!is_array($pedidosArquivo))
            $pedidosArquivo = [];

        $pedidos = array_merge($pedidosSessao, $pedidosArquivo);

        if (!isset($pedidos[$id])) {
            return redirect()->route('home')
                ->with('error', 'Pedido não encontrado!');
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
        // Usar um serviço de placeholder para QR Codes
        $valorFormatado = number_format($valor, 2, '', '');
        $textoQrCode = "00020126580014BR.GOV.BCB.PIX0136cobranca{$valorFormatado}{$numeroPedido}5204000053039865406{$valorFormatado}5802BR5901{$numeroPedido}6008Sao Paulo62070503***6304";

        // Gerar URL de QR code fake (usando serviço de placeholder)
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
            // Simular confirmação de pagamento
            $pedidos[$id]['status'] = 'confirmado';
            $pedidos[$id]['data_pagamento'] = now()->format('d/m/Y H:i:s');

            Session::put('pedidos', $pedidos);

            // Atualizar também no arquivo
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
     * Aplica cupom de desconto - CORRIGIDO
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

        // Simulação de validação de cupom
        $cupomValido = $this->validarCupom($request->codigo_cupom);

        if (!$cupomValido) {
            return response()->json([
                'success' => false,
                'message' => 'Cupom inválido ou expirado.'
            ]);
        }

        // Aplicar desconto baseado no cupom
        $desconto = $this->calcularDescontoCupom($request->codigo_cupom);

        // Atualizar sessão com o desconto E o código do cupom
        session()->put('desconto', $desconto);
        session()->put('cupom_aplicado', $request->codigo_cupom);

        // Recalcular totais
        $carrinho = session()->get('carrinho', []);
        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }

        $frete = session()->get('frete', 15.90);

        // Se for cupom de frete grátis, aplicar frete zero
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
     * Remove cupom de desconto - CORRIGIDO
     */
    public function removerCupom()
    {
        // Verificar se existe cupom aplicado
        $cupomAplicado = session()->get('cupom_aplicado');

        if (!$cupomAplicado) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum cupom aplicado para remover.'
            ]);
        }

        // Remover desconto e código do cupom da sessão
        session()->forget('desconto');
        session()->forget('cupom_aplicado');

        // Recalcular totais
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
        // Cupons válidos para simulação
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
            'FRETEGRATIS' => 0.00, // Frete grátis - desconto será aplicado no frete
            'BLACKFRIDAY' => 50.00,
            'SUPER10' => 10.00
        ];

        $codigoUpper = strtoupper($codigo);
        return $cupons[$codigoUpper] ?? 0.00;
    }

    /**
     * Calcula frete baseado no CEP - ATUALIZADO
     */
    public function calcularFrete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cep' => 'required|string|max:9'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'CEP inválido.'
            ]);
        }

        // Simulação de cálculo de frete baseado no CEP
        $cep = preg_replace('/[^0-9]/', '', $request->cep);

        // Lógica simples de cálculo de frete
        if (strpos($cep, '01000') === 0) {
            $frete = 12.90; // Região central
        } elseif (strpos($cep, '10000') === 0) {
            $frete = 18.90; // Outra região
        } else {
            $frete = 15.90; // Valor padrão
        }

        // Verificar se há cupom de frete grátis aplicado
        $cupomAplicado = session()->get('cupom_aplicado');
        if ($cupomAplicado && strtoupper($cupomAplicado) === 'FRETEGRATIS') {
            $frete = 0.00;
        }

        // Atualizar sessão com o frete
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
     * Lista de pedidos do usuário - CORRIGIDO
     */
    public function meusPedidos()
    {
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Faça login para visualizar suas compras.');
        }

        $user = Session::get('user');

        // Buscar pedidos da sessão - garantindo que seja array
        $pedidosSessao = Session::get('pedidos', []);
        if (!is_array($pedidosSessao)) {
            $pedidosSessao = [];
        }

        // Buscar pedidos do arquivo - garantindo que seja array
        $pedidosArquivo = $this->carregarPedidosArquivo();
        if (!is_array($pedidosArquivo)) {
            $pedidosArquivo = [];
        }

        // Combinar pedidos
        $todosPedidos = array_merge($pedidosSessao, $pedidosArquivo);

        // Filtrar pedidos por email do usuário
        $minhasCompras = [];
        foreach ($todosPedidos as $pedido) {
            // Verificar se a estrutura do pedido é válida
            if (
                is_array($pedido) &&
                isset($pedido['cliente']['email']) &&
                $pedido['cliente']['email'] === $user['email']
            ) {
                $minhasCompras[] = $pedido;
            }
        }

        // Ordenar por data (mais recente primeiro)
        usort($minhasCompras, function ($a, $b) {
            $dataA = isset($a['data']) ? strtotime(str_replace('/', '-', $a['data'])) : 0;
            $dataB = isset($b['data']) ? strtotime(str_replace('/', '-', $b['data'])) : 0;
            return $dataB - $dataA;
        });

        // Garantir que $minhasCompras seja sempre um array
        if (!is_array($minhasCompras)) {
            $minhasCompras = [];
        }

        return view('pages.produtos.minhascompras', [
            'minhasCompras' => $minhasCompras,
            'user' => $user
        ]);
    }

    /**
     * Detalhes de um pedido específico - CORRIGIDO
     */
    public function detalhesPedido($id)
    {
        if (!Session::get('user')) {
            return redirect()->route('login')->with('error', 'Faça login para visualizar seus pedidos.');
        }

        $user = Session::get('user');

        // Buscar pedidos da sessão e do arquivo
        $pedidosSessao = Session::get('pedidos', []);
        $pedidosArquivo = $this->carregarPedidosArquivo();

        // Garantir que ambos sejam arrays
        if (!is_array($pedidosSessao))
            $pedidosSessao = [];
        if (!is_array($pedidosArquivo))
            $pedidosArquivo = [];

        $todosPedidos = array_merge($pedidosSessao, $pedidosArquivo);

        if (!isset($todosPedidos[$id])) {
            return redirect()->route('minhas.compras')
                ->with('error', 'Pedido não encontrado!');
        }

        $pedido = $todosPedidos[$id];

        // Verificar se o pedido pertence ao usuário
        if (!isset($pedido['cliente']['email']) || $pedido['cliente']['email'] !== $user['email']) {
            return redirect()->route('minhas.compras')
                ->with('error', 'Você não tem permissão para visualizar este pedido!');
        }

        return view('pages.produtos.detalhes-compra', compact('pedido', 'user'));
    }

    /**
     * Filtra pedidos por critérios específicos
     */
    public function filtrar(Request $request)
    {
        if (!Session::get('user')) {
            return response()->json([
                'success' => false,
                'message' => 'Faça login para visualizar suas compras.'
            ], 401);
        }

        $user = Session::get('user');
        $filtro = $request->input('filtro', 'recentes');

        // Buscar pedidos da sessão e do arquivo
        $pedidosSessao = Session::get('pedidos', []);
        $pedidosArquivo = $this->carregarPedidosArquivo();

        // Garantir que ambos sejam arrays
        if (!is_array($pedidosSessao))
            $pedidosSessao = [];
        if (!is_array($pedidosArquivo))
            $pedidosArquivo = [];

        $todosPedidos = array_merge($pedidosSessao, $pedidosArquivo);

        // Filtrar pedidos por email do usuário
        $minhasCompras = [];
        foreach ($todosPedidos as $pedido) {
            if (is_array($pedido) && isset($pedido['cliente']['email']) && $pedido['cliente']['email'] === $user['email']) {
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