<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Realizada com Sucesso!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --dark: #1f2937;
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .success-container {
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            padding: 0 20px;
        }

        .success-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--secondary) 0%, #0d966c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: scaleUp 0.5s ease-out;
        }

        .success-icon i {
            font-size: 3.5rem;
            color: white;
        }

        @keyframes scaleUp {
            0% { transform: scale(0); opacity: 0; }
            70% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        .success-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .success-subtitle {
            font-size: 1.2rem;
            color: #6b7280;
            margin-bottom: 2.5rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .order-details {
            background: var(--lighter);
            border-radius: 16px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
            border: 1px solid #e5e7eb;
        }

        .detail-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e5e7eb;
            color: var(--dark);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            font-weight: 500;
            color: #6b7280;
        }

        .detail-value {
            font-weight: 600;
            color: var(--dark);
        }

        .product-list {
            margin-top: 1.5rem;
        }

        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.2rem;
            padding-bottom: 1.2rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .product-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .product-image {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            overflow: hidden;
            margin-right: 1rem;
            border: 2px solid #e5e7eb;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            flex: 1;
            text-align: left;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .product-price {
            color: var(--primary);
            font-weight: 700;
        }

        .product-quantity {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 2.5rem;
        }

        @media (max-width: 576px) {
            .action-buttons {
                grid-template-columns: 1fr;
            }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 1.8rem;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            gap: 0.6rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .btn-outline {
            background: white;
            color: var(--dark);
            border: 2px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn-outline:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: var(--dark);
        }

        .confetti {
            position: absolute;
            z-index: -1;
            pointer-events: none;
        }

        .whatsapp-notification {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .whatsapp-notification i {
            font-size: 1.5rem;
        }

        .notification-text {
            flex: 1;
            text-align: left;
        }

        .notification-text strong {
            display: block;
            margin-bottom: 0.2rem;
        }

        @media (max-width: 768px) {
            .success-card {
                padding: 2rem 1.5rem;
            }
            
            .success-title {
                font-size: 2rem;
            }
            
            .success-subtitle {
                font-size: 1.1rem;
            }
            
            .order-details {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="main-content">
        <div class="success-container">
            <div class="success-card">
                <!-- Confetti animation elements -->
                <div class="confetti" style="top: 10%; left: 5%; animation: fall 8s linear infinite;"></div>
                <div class="confetti" style="top: 15%; left: 15%; animation: fall 10s linear infinite;"></div>
                <div class="confetti" style="top: 5%; right: 10%; animation: fall 9s linear infinite;"></div>
                <div class="confetti" style="top: 20%; right: 5%; animation: fall 7s linear infinite;"></div>
                
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                
                <h1 class="success-title">Compra Realizada com Sucesso!</h1>
                <p class="success-subtitle">Obrigado por sua compra! Seu pedido foi processado e em breve estará a caminho.</p>
                
                <div class="order-details">
                    <h2 class="detail-title">Detalhes do Pedido</h2>
                    
                    @if(isset($ultimoPedido))
                        <div class="detail-item">
                            <span class="detail-label">Número do Pedido:</span>
                            <span class="detail-value">{{ $ultimoPedido['numero'] ?? 'N/A' }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Data da Compra:</span>
                            <span class="detail-value">{{ $ultimoPedido['data'] ?? now()->format('d/m/Y H:i:s') }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Método de Pagamento:</span>
                            <span class="detail-value">{{ ucfirst($ultimoPedido['metodo_pagamento'] ?? 'N/A') }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Subtotal:</span>
                            <span class="detail-value">R$ {{ number_format($ultimoPedido['subtotal'] ?? 0, 2, ',', '.') }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Frete:</span>
                            <span class="detail-value">R$ {{ number_format($ultimoPedido['frete'] ?? 0, 2, ',', '.') }}</span>
                        </div>
                        
                        @if(($ultimoPedido['desconto'] ?? 0) > 0)
                        <div class="detail-item">
                            <span class="detail-label">Desconto:</span>
                            <span class="detail-value" style="color: var(--secondary);">-R$ {{ number_format($ultimoPedido['desconto'] ?? 0, 2, ',', '.') }}</span>
                        </div>
                        @endif
                        
                        <div class="detail-item">
                            <span class="detail-label">Total Pago:</span>
                            <span class="detail-value">R$ {{ number_format($ultimoPedido['total'] ?? 0, 2, ',', '.') }}</span>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Status:</span>
                            <span class="detail-value" style="color: var(--secondary);">
                                @if(($ultimoPedido['status'] ?? '') === 'aguardando_pagamento')
                                    Aguardando Pagamento
                                @else
                                    Pagamento Aprovado
                                @endif
                            </span>
                        </div>
                        
                        <div class="product-list">
                            <h3 style="font-size: 1.1rem; margin-bottom: 1rem; color: var(--dark);">Produtos:</h3>
                            
                            @if(isset($ultimoPedido['itens']) && count($ultimoPedido['itens']) > 0)
                                @foreach($ultimoPedido['itens'] as $item)
                                    <div class="product-item">
                                        <div class="product-image">
                                            <img src="{{ asset('storage/' . $item['imagem']) }}" alt="{{ $item['nome'] }}">
                                        </div>
                                        <div class="product-info">
                                            <div class="product-name">{{ $item['nome'] }}</div>
                                            <div class="product-price">R$ {{ number_format($item['preco'], 2, ',', '.') }}</div>
                                            <div class="product-quantity">Quantidade: {{ $item['quantidade'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p style="color: #6b7280; text-align: center;">Nenhum produto encontrado</p>
                            @endif
                        </div>
                    @else
                        <p style="color: #6b7280; text-align: center;">Informações do pedido não disponíveis</p>
                    @endif
                </div>
                
                <div class="whatsapp-notification">
                    <i class="fab fa-whatsapp"></i>
                    <div class="notification-text">
                        <strong>Receba atualizações por WhatsApp</strong>
                        <span>Enviaremos o código de rastreio assim que seu pedido for despachado!</span>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="{{ route('produtos.index') }}" class="btn btn-outline">
                        <i class="fas fa-shopping-bag"></i>
                        Continuar Comprando
                    </a>
                    <a href="{{ route('minhas.compras') }}" class="btn btn-primary">
                        <i class="fas fa-clipboard-list"></i>
                        Ver Meus Pedidos
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
    <script>
        // Adiciona animação de confetti
        document.addEventListener('DOMContentLoaded', function() {
            createConfetti();
        });

        function createConfetti() {
            const colors = ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];
            const container = document.querySelector('.success-card');
            
            for (let i = 0; i < 20; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.innerHTML = '<i class="fas fa-circle"></i>';
                confetti.style.color = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.fontSize = (Math.random() * 10 + 8) + 'px';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = -20 + 'px';
                confetti.style.opacity = Math.random();
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                
                const animationDuration = (Math.random() * 5 + 5) + 's';
                const animationDelay = (Math.random() * 2) + 's';
                
                confetti.style.animation = `fall ${animationDuration} ${animationDelay} linear infinite`;
                
                container.appendChild(confetti);
            }
        }

        // Adiciona keyframes para a animação do confetti
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fall {
                0% {
                    transform: translateY(0) rotate(0deg);
                    opacity: 1;
                }
                100% {
                    transform: translateY(500px) rotate(360deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>