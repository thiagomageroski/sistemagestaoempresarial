<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Compras - Histórico de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #c7d2fe;
            --secondary: #10b981;
            --accent: #f59e0b;
            --danger: #ef4444;
            --dark: #1f2937;
            --dark-gray: #4b5563;
            --gray: #9ca3af;
            --light-gray: #e5e7eb;
            --light: #f3f4f6;
            --lighter: #f9fafb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        .page-header {
            text-align: center;
            margin: 2rem 0 3rem;
            padding: 0 1rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--dark-gray);
            font-size: 1.1rem;
            font-weight: 400;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--light-gray);
        }

        .filter-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-title i {
            color: var(--primary);
        }

        .filter-buttons {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.7rem 1.2rem;
            border: 2px solid var(--light-gray);
            border-radius: 10px;
            background: white;
            color: var(--dark-gray);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-color: var(--primary);
            color: white;
        }

        /* Orders Container */
        .orders-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Order Card */
        .order-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--light-gray);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 4px;
            background: var(--primary);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .order-info {
            flex: 1;
        }

        .order-number {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .order-date {
            color: var(--dark-gray);
            font-size: 0.95rem;
        }

        .order-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .status-confirmado {
            background: rgba(16, 185, 129, 0.1);
            color: var(--secondary);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-pendente {
            background: rgba(245, 158, 11, 0.1);
            color: var(--accent);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .status-cancelado {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-aguardando {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .detail-label {
            font-size: 0.9rem;
            color: var(--dark-gray);
            font-weight: 500;
        }

        .detail-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
        }

        .detail-value.total {
            color: var(--primary);
            font-size: 1.3rem;
        }

        .order-products {
            margin: 1.5rem 0;
        }

        .products-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .products-title i {
            color: var(--primary);
        }

        .product-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: var(--lighter);
            border-radius: 12px;
            border: 1px solid var(--light-gray);
        }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            overflow: hidden;
            margin-right: 1rem;
            border: 2px solid var(--light);
            flex-shrink: 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: var(--dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-details {
            display: flex;
            gap: 1rem;
            font-size: 0.9rem;
            color: var(--dark-gray);
            flex-wrap: wrap;
        }

        .product-price {
            color: var(--primary);
            font-weight: 600;
        }

        .order-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            gap: 0.5rem;
            text-decoration: none;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            text-decoration: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .btn-outline {
            background: white;
            color: var(--dark);
            border: 2px solid var(--light-gray);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-decoration: none;
        }

        .btn-outline:hover {
            background: var(--lighter);
            border-color: var(--gray);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: var(--dark);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--light-gray);
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--light-gray);
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }

        .empty-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .empty-text {
            color: var(--dark-gray);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        /* Loading */
        .loading {
            text-align: center;
            padding: 3rem;
            color: var(--dark-gray);
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--light);
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 0.8rem;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1000;
            border-left: 4px solid var(--primary);
        }

        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast.success {
            border-left-color: var(--secondary);
        }

        .toast.error {
            border-left-color: var(--danger);
        }

        .toast i {
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .toast.success i {
            color: var(--secondary);
        }

        .toast.error i {
            color: var(--danger);
        }

        .toast span {
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-details {
                grid-template-columns: 1fr;
            }

            .order-actions {
                justify-content: stretch;
            }

            .btn {
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 15px;
            }

            .order-card {
                padding: 1.5rem;
            }

            .filter-buttons {
                flex-direction: column;
            }

            .filter-btn {
                justify-content: center;
            }

            .product-details {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container py-5">
            <div class="page-header">
                <h1 class="page-title">Minhas Compras</h1>
                <p class="page-subtitle">Acompanhe todo o seu histórico de pedidos</p>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <h3 class="filter-title">
                    <i class="fas fa-filter"></i>
                    Filtrar por:
                </h3>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="recentes">
                        <i class="fas fa-clock"></i>
                        Mais Recentes
                    </button>
                    <button class="filter-btn" data-filter="antigos">
                        <i class="fas fa-history"></i>
                        Mais Antigos
                    </button>
                    <button class="filter-btn" data-filter="valor_maior">
                        <i class="fas fa-arrow-up"></i>
                        Maior Valor
                    </button>
                    <button class="filter-btn" data-filter="valor_menor">
                        <i class="fas fa-arrow-down"></i>
                        Menor Valor
                    </button>
                </div>
            </div>

            <!-- Orders Container -->
            <div class="orders-container" id="ordersContainer">
                @if(isset($minhasCompras) && is_array($minhasCompras) && count($minhasCompras) > 0)
                    @foreach($minhasCompras as $compra)
                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-info">
                                    <div class="order-number">{{ $compra['numero'] ?? 'N/A' }}</div>
                                    <div class="order-date">
                                        <i class="far fa-calendar-alt"></i>
                                        {{ $compra['data'] ?? 'Data não disponível' }}
                                    </div>
                                </div>
                                <span class="order-status 
                                                    @if(($compra['status'] ?? '') === 'confirmado') status-confirmado
                                                    @elseif(($compra['status'] ?? '') === 'aguardando_pagamento') status-aguardando
                                                    @elseif(($compra['status'] ?? '') === 'cancelado') status-cancelado
                                                    @else status-pendente @endif">
                                    <i class="fas 
                                                        @if(($compra['status'] ?? '') === 'confirmado') fa-check-circle
                                                        @elseif(($compra['status'] ?? '') === 'aguardando_pagamento') fa-clock
                                                        @elseif(($compra['status'] ?? '') === 'cancelado') fa-times-circle
                                                        @else fa-clock @endif"></i>
                                    @if(($compra['status'] ?? '') === 'confirmado') Confirmado
                                    @elseif(($compra['status'] ?? '') === 'aguardando_pagamento') Aguardando Pagamento
                                    @elseif(($compra['status'] ?? '') === 'cancelado') Cancelado
                                    @else Pendente @endif
                                </span>
                            </div>

                            <div class="order-details">
                                <div class="detail-item">
                                    <span class="detail-label">Método de Pagamento</span>
                                    <span class="detail-value">
                                        <i class="fas 
                                                            @if(($compra['metodo_pagamento'] ?? '') === 'cartao') fa-credit-card
                                                            @elseif(($compra['metodo_pagamento'] ?? '') === 'pix') fa-qrcode
                                                            @elseif(($compra['metodo_pagamento'] ?? '') === 'boleto') fa-barcode
                                                            @else fa-money-bill @endif"></i>
                                        {{ ucfirst($compra['metodo_pagamento'] ?? 'N/A') }}
                                    </span>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Subtotal</span>
                                    <span class="detail-value">R$
                                        {{ number_format($compra['subtotal'] ?? 0, 2, ',', '.') }}</span>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">Frete</span>
                                    <span class="detail-value">R$ {{ number_format($compra['frete'] ?? 0, 2, ',', '.') }}</span>
                                </div>

                                @if(($compra['desconto'] ?? 0) > 0)
                                    <div class="detail-item">
                                        <span class="detail-label">Desconto</span>
                                        <span class="detail-value" style="color: var(--secondary);">
                                            -R$ {{ number_format($compra['desconto'] ?? 0, 2, ',', '.') }}
                                        </span>
                                    </div>
                                @endif

                                <div class="detail-item">
                                    <span class="detail-label">Total</span>
                                    <span class="detail-value total">R$
                                        {{ number_format($compra['total'] ?? 0, 2, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="order-products">
                                <h4 class="products-title">
                                    <i class="fas fa-shopping-bag"></i>
                                    Produtos Comprados
                                </h4>
                                <div class="product-list">
                                    @if(isset($compra['itens']) && count($compra['itens']) > 0)
                                        @foreach($compra['itens'] as $item)
                                            <div class="product-item">
                                                <div class="product-image">
                                                    <img src="{{ asset('storage/' . $item['imagem']) }}" alt="{{ $item['nome'] }}">
                                                </div>
                                                <div class="product-info">
                                                    <div class="product-name">{{ $item['nome'] }}</div>
                                                    <div class="product-details">
                                                        <span class="product-price">R$
                                                            {{ number_format($item['preco'], 2, ',', '.') }}</span>
                                                        <span class="product-quantity">Qtd: {{ $item['quantidade'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p style="color: var(--dark-gray); text-align: center; padding: 1rem;">Nenhum produto
                                            encontrado</p>
                                    @endif
                                </div>
                            </div>

                            <div class="order-actions">


                                @if(($compra['status'] ?? '') === 'aguardando_pagamento')

                                @endif

                                <a href="{{ route('produtos.index') }}" class="btn btn-outline">
                                    <i class="fas fa-shopping-bag"></i>
                                    Comprar Novamente
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3 class="empty-title">Nenhuma compra encontrada</h3>
                        <p class="empty-text">Você ainda não realizou nenhuma compra em nossa loja.</p>
                        <a href="{{ route('produtos.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag"></i>
                            Fazer Minha Primeira Compra
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Filtros
            const filterButtons = document.querySelectorAll('.filter-btn');
            const ordersContainer = document.getElementById('ordersContainer');

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');
                    filtrarCompras(filter);
                });
            });

            function filtrarCompras(filtro) {
                // Show loading
                ordersContainer.innerHTML = `
                    <div class="loading">
                        <div class="spinner"></div>
                        <p>Filtrando compras...</p>
                    </div>
                `;

                fetch('{{ route("filtrar.compras") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ filtro: filtro })
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na resposta do servidor');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            atualizarListaCompras(data.compras);
                        } else {

                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);

                        location.reload();
                    });
            }

            function atualizarListaCompras(compras) {
                if (!compras || compras.length === 0) {
                    ordersContainer.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3 class="empty-title">Nenhuma compra encontrada</h3>
                            <p class="empty-text">Não encontramos compras com este filtro.</p>
                        </div>
                    `;
                    return;
                }

                let html = '';
                compras.forEach(compra => {
                    // Verificar se os itens existem e estão no formato correto
                    // O backend pode retornar 'itens' ou 'items', então verificamos ambos
                    const itens = compra.itens || compra.items || [];

                    // DEBUG: Log para verificar a estrutura completa da compra
                    console.log('Estrutura completa da compra:', compra);

                    html += `
                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-info">
                                    <div class="order-number">${compra.numero || 'N/A'}</div>
                                    <div class="order-date">
                                        <i class="far fa-calendar-alt"></i>
                                        ${compra.data || 'Data não disponível'}
                                    </div>
                                </div>
                                <span class="order-status ${getStatusClass(compra.status)}">
                                    <i class="fas ${getStatusIcon(compra.status)}"></i>
                                    ${getStatusText(compra.status)}
                                </span>
                            </div>

                            <div class="order-details">
                                <div class="detail-item">
                                    <span class="detail-label">Método de Pagamento</span>
                                    <span class="detail-value">
                                        <i class="fas ${getPaymentIcon(compra.metodo_pagamento)}"></i>
                                        ${capitalizeFirst(compra.metodo_pagamento || 'N/A')}
                                    </span>
                                </div>
                                
                                <div class="detail-item">
                                    <span class="detail-label">Subtotal</span>
                                    <span class="detail-value">R$ ${formatCurrency(compra.subtotal || 0)}</span>
                                </div>
                                
                                <div class="detail-item">
                                    <span class="detail-label">Frete</span>
                                    <span class="detail-value">R$ ${formatCurrency(compra.frete || 0)}</span>
                                </div>
                                
                                ${(compra.desconto || 0) > 0 ? `
                                <div class="detail-item">
                                    <span class="detail-label">Desconto</span>
                                    <span class="detail-value" style="color: var(--secondary);">
                                        -R$ ${formatCurrency(compra.desconto)}
                                    </span>
                                </div>
                                ` : ''}
                                
                                <div class="detail-item">
                                    <span class="detail-label">Total</span>
                                    <span class="detail-value total">R$ ${formatCurrency(compra.total || 0)}</span>
                                </div>
                            </div>

                            <div class="order-products">
                                <h4 class="products-title">
                                    <i class="fas fa-shopping-bag"></i>
                                    Produtos Comprados
                                </h4>
                                <div class="product-list">
                                    ${renderProductList(itens)}
                                </div>
                            </div>

                            <div class="order-actions">
                                <a href="/minhascompras/${compra.numero}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                    Ver Detalhes
                                </a>
                                
                                ${compra.status === 'aguardando_pagamento' ? `
                                <button class="btn btn-danger" onclick="cancelarPedido('${compra.numero}')">
                                    <i class="fas fa-times"></i>
                                    Cancelar Pedido
                                </button>
                                ` : ''}
                                
                                <a href="{{ route('produtos.index') }}" class="btn btn-outline">
                                    <i class="fas fa-shopping-bag"></i>
                                    Comprar Novamente
                                </a>
                            </div>
                        </div>
                    `;
                });

                ordersContainer.innerHTML = html;
            }

            function renderProductList(itens) {
                if (!itens || itens.length === 0) {
                    return '<p style="color: var(--dark-gray); text-align: center; padding: 1rem;">Nenhum produto encontrado</p>';
                }

                let productHtml = '';

                itens.forEach(item => {
                    // DEBUG: Log para verificar a estrutura do item
                    console.log('Estrutura do item:', item);

                    // Verificar se o item é um objeto válido
                    if (typeof item !== 'object' || item === null) {
                        console.warn('Item inválido:', item);
                        return;
                    }

                    // Extrair propriedades do item com fallbacks
                    const nome = item.nome || item.name || item.product_name || item.produto_nome ||
                        item.title || item.titulo || 'Produto não especificado';

                    const preco = item.preco || item.price || item.valor || item.product_price ||
                        item.produto_preco || item.value || 0;

                    const quantidade = item.quantidade || item.quantity || item.qtd || item.product_quantity ||
                        item.produto_quantidade || item.amount || 1;

                    const imagem = item.imagem || item.image || item.img || item.product_image ||
                        item.produto_imagem || item.picture || item.foto || 'https://via.placeholder.com/60';

                    productHtml += `
                        <div class="product-item">
                            <div class="product-image">
                                <img src="${imagem}" alt="${nome}" onerror="this.src='https://via.placeholder.com/60'">
                            </div>
                            <div class="product-info">
                                <div class="product-name">${nome}</div>
                                <div class="product-details">
                                    <span class="product-price">R$ ${formatCurrency(preco)}</span>
                                    <span class="product-quantity">Qtd: ${quantidade}</span>
                                </div>
                            </div>
                        </div>
                    `;
                });

                return productHtml;
            }

            function getStatusClass(status) {
                if (!status) return 'status-pendente';
                switch (status) {
                    case 'confirmado': return 'status-confirmado';
                    case 'aguardando_pagamento': return 'status-aguardando';
                    case 'cancelado': return 'status-cancelado';
                    default: return 'status-pendente';
                }
            }

            function getStatusIcon(status) {
                if (!status) return 'fa-clock';
                switch (status) {
                    case 'confirmado': return 'fa-check-circle';
                    case 'aguardando_pagamento': return 'fa-clock';
                    case 'cancelado': return 'fa-times-circle';
                    default: return 'fa-clock';
                }
            }

            function getStatusText(status) {
                if (!status) return 'Pendente';
                switch (status) {
                    case 'confirmado': return 'Confirmado';
                    case 'aguardando_pagamento': return 'Aguardando Pagamento';
                    case 'cancelado': return 'Cancelado';
                    default: return 'Pendente';
                }
            }

            function getPaymentIcon(method) {
                if (!method) return 'fa-money-bill';
                switch (method) {
                    case 'cartao': return 'fa-credit-card';
                    case 'pix': return 'fa-qrcode';
                    case 'boleto': return 'fa-barcode';
                    default: return 'fa-money-bill';
                }
            }

            function capitalizeFirst(string) {
                if (!string) return 'N/A';
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            function formatCurrency(value) {
                const num = parseFloat(value) || 0;
                return num.toFixed(2).replace('.', ',');
            }
        });

        function cancelarPedido(pedidoId) {
            if (!confirm('Tem certeza que deseja cancelar este pedido?')) {
                return;
            }

            fetch(`/minhascompras/cancelar/${pedidoId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarToast(data.message, 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        mostrarToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    mostrarToast('Erro ao cancelar pedido.', 'error');
                });
        }

        function mostrarToast(mensagem, tipo = 'success') {
            // Remover toasts existentes
            document.querySelectorAll('.toast').forEach(toast => toast.remove());

            const toast = document.createElement('div');
            toast.className = `toast ${tipo}`;
            toast.innerHTML = `
                <i class="fas ${tipo === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${mensagem}</span>
            `;

            document.body.appendChild(toast);

            // Trigger reflow para garantir que a animação funcione
            toast.offsetHeight;

            setTimeout(() => toast.classList.add('show'), 100);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }
    </script>
</body>

</html>