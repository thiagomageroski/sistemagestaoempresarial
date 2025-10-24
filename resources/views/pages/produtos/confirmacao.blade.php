<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Pedido - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .status-badge {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(79, 70, 229, 0); }
            100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
        }
        
        .qr-code {
            transition: transform 0.3s ease;
        }
        
        .qr-code:hover {
            transform: scale(1.05);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            transform: translateY(-1px);
        }
        
        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        
        .product-image {
            transition: transform 0.3s ease;
        }
        
        .product-image:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="antialiased">
    @include('partials.navbar')
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full gradient-bg text-white mb-6 animate-bounce-slow">
                    @if($pedido['status'] === 'confirmado')
                    <i class="fas fa-check-circle text-3xl"></i>
                    @elseif($pedido['status'] === 'aguardando_pagamento')
                    <i class="fas fa-clock text-3xl"></i>
                    @else
                    <i class="fas fa-receipt text-3xl"></i>
                    @endif
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    @if($pedido['status'] === 'confirmado')
                    Pedido Confirmado! 🎉
                    @elseif($pedido['status'] === 'aguardando_pagamento')
                    Aguardando Pagamento
                    @else
                    Detalhes do Pedido
                    @endif
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    @if($pedido['status'] === 'confirmado')
                    Obrigado por sua compra! Seu pedido #{{ $pedido['numero'] }} foi confirmado e já está sendo processado.
                    @elseif($pedido['status'] === 'aguardando_pagamento')
                    Estamos aguardando a confirmação do pagamento para processar seu pedido #{{ $pedido['numero'] }}.
                    @else
                    Aqui estão os detalhes do seu pedido #{{ $pedido['numero'] }}.
                    @endif
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Order Summary Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Resumo do Pedido</h2>
                            <span class="status-badge px-4 py-2 rounded-full text-sm font-semibold 
                                @if($pedido['status'] === 'confirmado') bg-green-100 text-green-800
                                @elseif($pedido['status'] === 'aguardando_pagamento') bg-yellow-100 text-yellow-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $pedido['status'])) }}
                            </span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <i class="fas fa-hashtag text-purple-500 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Número do Pedido</p>
                                        <p class="font-semibold text-gray-800">{{ $pedido['numero'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="far fa-calendar text-purple-500 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Data do Pedido</p>
                                        <p class="font-semibold text-gray-800">{{ $pedido['data'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <i class="fas fa-credit-card text-purple-500 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Método de Pagamento</p>
                                        <p class="font-semibold text-gray-800 capitalize">
                                            {{ $pedido['metodo_pagamento'] }}
                                        </p>
                                    </div>
                                </div>
                                @if(isset($pedido['data_pagamento']))
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-purple-500 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Pagamento em</p>
                                        <p class="font-semibold text-gray-800">{{ $pedido['data_pagamento'] }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Order Items -->
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Itens do Pedido</h3>
                        <div class="space-y-6">
                            @foreach($pedido['itens'] as $item)
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <img src="{{ asset('storage/' . $item['imagem']) }}" alt="{{ $item['nome'] }}"> 
                                    class="w-20 h-20 object-cover rounded-lg product-image shadow-md">
                                <div class="ml-6 flex-grow">
                                    <h4 class="font-semibold text-gray-800 text-lg">{{ $item['nome'] }}</h4>
                                    <p class="text-gray-600 text-sm">Quantidade: {{ $item['quantidade'] }}</p>
                                    <p class="text-purple-600 font-medium">R$ {{ number_format($item['preco'], 2, ',', '.') }} cada</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800 text-lg">R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Shipping Information Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Informações de Entrega</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Nome completo</p>
                                    <p class="font-semibold text-gray-800">{{ $pedido['cliente']['nome'] }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">E-mail</p>
                                    <p class="font-semibold text-gray-800">{{ $pedido['cliente']['email'] }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Telefone</p>
                                    <p class="font-semibold text-gray-800">{{ $pedido['cliente']['telefone'] }}</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Endereço</p>
                                    <p class="font-semibold text-gray-800">{{ $pedido['cliente']['endereco'] }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Cidade</p>
                                        <p class="font-semibold text-gray-800">{{ $pedido['cliente']['cidade'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Estado</p>
                                        <p class="font-semibold text-gray-800">{{ $pedido['cliente']['estado'] }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">CEP</p>
                                    <p class="font-semibold text-gray-800">{{ $pedido['cliente']['cep'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Payment Summary Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-6 card-hover">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Resumo Financeiro</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold text-gray-800">R$ {{ number_format($pedido['subtotal'], 2, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Frete</span>
                                <span class="font-semibold text-gray-800">R$ {{ number_format($pedido['frete'], 2, ',', '.') }}</span>
                            </div>
                            @if($pedido['desconto'] > 0)
                            <div class="flex justify-between items-center text-green-600">
                                <span>Desconto</span>
                                <span class="font-semibold">-R$ {{ number_format($pedido['desconto'], 2, ',', '.') }}</span>
                            </div>
                            @endif
                            <div class="border-t border-gray-200 pt-4 flex justify-between items-center text-xl font-bold">
                                <span class="text-gray-800">Total</span>
                                <span class="text-purple-600">R$ {{ number_format($pedido['total'], 2, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- PIX Payment Section -->
                        @if($pedido['metodo_pagamento'] === 'pix' && $pedido['status'] === 'aguardando_pagamento')
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Pagamento via PIX</h3>
                            
                            <div class="text-center mb-6">
                                <div class="inline-block p-4 bg-white border-2 border-dashed border-purple-200 rounded-2xl mb-4">
                                    <img src="{{ $qrCodeUrl }}" alt="QR Code PIX" class="w-48 h-48 mx-auto qr-code">
                                </div>
                                <p class="text-sm text-gray-600">Escaneie o QR Code com seu app bancário</p>
                            </div>
                            
                            <div class="mb-6">
                                <p class="text-sm text-gray-600 mb-3 font-medium">Ou copie o código PIX:</p>
                                <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl p-4">
                                    <input type="text" id="pixCode" value="{{ $pixCode }}" readonly 
                                        class="flex-grow bg-transparent outline-none text-xs font-mono">
                                    <button onclick="copiarPixCode()" 
                                        class="ml-3 bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-purple-700 transition-colors">
                                        <i class="fas fa-copy mr-1"></i> Copiar
                                    </button>
                                </div>
                            </div>
                            

                            
                            <div class="text-center">
                                <div id="statusPagamento" class="hidden">
                                    <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-sync-alt animate-spin mr-2"></i> Processando...
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="border-t border-gray-200 pt-6 space-y-4">
                            <a href="{{ route('minhas.compras') }}" 
                                class="block w-full btn-secondary text-white py-4 rounded-xl font-semibold text-center">
                                <i class="fas fa-list mr-2"></i> Meus Pedidos
                            </a>
                            <a href="{{ route('home') }}" 
                                class="block w-full border-2 border-gray-300 text-gray-700 py-4 rounded-xl font-semibold text-center hover:bg-gray-50 transition-colors">
                                <i class="fas fa-home mr-2"></i> Voltar à Loja
                            </a>
                            <a href="{{ route('produtos.index') }}" 
                                class="block w-full border-2 border-purple-200 text-purple-600 py-4 rounded-xl font-semibold text-center hover:bg-purple-50 transition-colors">
                                <i class="fas fa-shopping-bag mr-2"></i> Continuar Comprando
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    @if($pedido['metodo_pagamento'] === 'pix' && $pedido['status'] === 'aguardando_pagamento')
    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
    <script>
    function copiarPixCode() {
        const pixCode = document.getElementById('pixCode');
        pixCode.select();
        pixCode.setSelectionRange(0, 99999);
        document.execCommand('copy');
        
        // Show notification
        showNotification('Código PIX copiado para a área de transferência!', 'success');
    }
    
    function simularPagamento(pedidoId) {
        const statusDiv = document.getElementById('statusPagamento');
        const btn = event.target;
        const originalText = btn.innerHTML;
        
        // Show processing status
        statusDiv.classList.remove('hidden');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-sync-alt animate-spin mr-2"></i> Processando...';
        btn.classList.remove('btn-primary');
        btn.classList.add('bg-gray-400', 'cursor-not-allowed');
        
        // Simulate AJAX request
        setTimeout(() => {
            fetch(`/checkout/atualizar-status/${pedidoId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusDiv.innerHTML = `
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            <i class="fas fa-check-circle mr-2"></i> Pagamento confirmado!
                        </span>
                    `;
                    showNotification('Pagamento confirmado com sucesso!', 'success');
                    
                    // Reload page after 2 seconds
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                statusDiv.innerHTML = `
                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Erro ao processar
                    </span>
                `;
                btn.disabled = false;
                btn.innerHTML = originalText;
                btn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                btn.classList.add('btn-primary');
                showNotification('Erro ao processar pagamento. Tente novamente.', 'error');
            });
        }, 2000);
    }
    
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg font-semibold transform transition-all duration-300 ${
            type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'} mr-2"></i>
                ${message}
            </div>
        `;
        
        // Add to body
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
    </script>
    @endif
</body>
</html>