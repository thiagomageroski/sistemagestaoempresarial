<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras - TechStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome@6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --accent-color: #ff6b6b;
            --success-color: #51cf66;
            --text-dark: #2d3748;
            --text-light: #718096;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
            --card-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            --card-hover-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf1 100%);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Navbar Modernizada */
        .navbar-modern {
            background: var(--primary-gradient);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
        }

        .navbar-brand-modern {
            font-size: 1.8rem;
            font-weight: 800;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .navbar-brand-modern i {
            background: rgba(255, 255, 255, 0.15);
            padding: 0.7rem;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        /* Conteúdo Principal */
        .main-content {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInUp 0.8s ease;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .page-subtitle {
            color: var(--text-light);
            font-size: 1.3rem;
            font-weight: 400;
        }

        /* Cart Container Modernizado */
        .cart-container-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInUp 0.6s ease;
        }

        .cart-header-modern {
            padding: 2rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-title-modern {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .cart-badge-modern {
            background: var(--primary-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Cart Items Modernizados */
        .cart-items-modern {
            padding: 0;
        }

        .cart-item-modern {
            display: flex;
            align-items: center;
            padding: 2rem;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            animation: fadeIn 0.5s ease;
        }

        .cart-item-modern:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            transform: translateX(5px);
        }

        .item-image-modern {
            width: 120px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            margin-right: 2rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .item-image-modern:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .item-details-modern {
            flex: 1;
        }

        .item-name-modern {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .item-price-modern {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .item-quantity-modern {
            display: flex;
            align-items: center;
            margin: 0 2rem;
            background: rgba(102, 126, 234, 0.1);
            padding: 0.5rem;
            border-radius: 12px;
        }

        .quantity-btn-modern {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--border-color);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .quantity-btn-modern:hover {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
            transform: scale(1.1);
        }

        .quantity-input-modern {
            width: 60px;
            text-align: center;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 0.6rem;
            margin: 0 0.8rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .quantity-input-modern:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }

        .item-total-modern {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 2rem;
            min-width: 120px;
            text-align: right;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
        }

        .item-remove-modern {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            cursor: pointer;
            padding: 0.8rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
        }

        .item-remove-modern:hover {
            background: #ef4444;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
        }

        /* Cart Summary Modernizado */
        .cart-summary-modern {
            padding: 2.5rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            border-top: 1px solid var(--border-color);
        }

        .summary-row-modern {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
            padding: 0.8rem 0;
        }

        .summary-label-modern {
            font-size: 1.2rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .summary-value-modern {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .summary-total-modern {
            border-top: 2px solid var(--border-color);
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .total-label-modern {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .total-value-modern {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--accent-color);
        }

        .checkout-btn-modern {
            width: 100%;
            padding: 1.5rem 2rem;
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.3rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .checkout-btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }

        .checkout-btn-modern:active {
            transform: translateY(-1px);
        }

        /* Empty Cart Modernizado */
        .empty-cart-modern {
            text-align: center;
            padding: 4rem 2rem;
            animation: fadeIn 0.8s ease;
            display: none; /* Inicialmente oculto */
        }

        .empty-cart-modern.show {
            display: block;
        }

        .empty-icon-modern {
            font-size: 5rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            opacity: 0.7;
        }

        .empty-title-modern {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        .empty-text-modern {
            color: var(--text-light);
            margin-bottom: 3rem;
            font-size: 1.2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .continue-btn-modern {
            background: var(--primary-gradient);
            color: white;
            padding: 1.2rem 2.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .continue-btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Continue Shopping */
        .continue-shopping-modern {
            text-align: center;
            margin-top: 3rem;
            animation: fadeIn 0.8s ease;
            display: none;
        }

        .continue-shopping-modern.show {
            display: block;
        }

        .continue-link-modern {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.3s ease;
            padding: 1rem 2rem;
            border: 2px solid var(--accent-color);
            border-radius: 12px;
        }

        .continue-link-modern:hover {
            background: var(--accent-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
        }

        /* Modal de Confirmação */
        .confirmation-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .confirmation-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content-modern {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            text-align: center;
            transform: scale(0.9);
            transition: all 0.3s ease;
        }

        .confirmation-modal.show .modal-content-modern {
            transform: scale(1);
        }

        .modal-icon {
            font-size: 3rem;
            color: #ef4444;
            margin-bottom: 1.5rem;
            display: none;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .modal-message {
            color: var(--text-light);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .modal-btn {
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-btn-cancel {
            background: #e2e8f0;
            color: var(--text-dark);
        }

        .modal-btn-cancel:hover {
            background: #cbd5e0;
        }

        .modal-btn-confirm {
            background: #ef4444;
            color: white;
        }

        .modal-btn-confirm:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
        }

        .toast {
            background: white;
            padding: 1.2rem 1.8rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: slideInRight 0.3s ease;
            border-left: 4px solid var(--success-color);
        }

        .toast.error {
            border-left-color: #ef4444;
        }

        .toast i {
            font-size: 1.4rem;
        }

        .toast.success i {
            color: var(--success-color);
        }

        .toast.error i {
            color: #ef4444;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: var(--text-dark);
        }

        .toast-message {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .spinner-modern {
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--accent-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

           100% {
                transform: rotate(360deg);
            }
        }

        /* Responsividade */
        @media (max-width: 968px) {
            .cart-item-modern {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
            }

            .item-image-modern {
                margin-right: 0;
                margin-bottom: 1.5rem;
                width: 100px;
                height: 100px;
            }

            .item-quantity-modern {
                margin: 1.5rem 0;
            }

            .item-total-modern {
                margin: 1rem 0;
                text-align: center;
            }

            .page-title {
                font-size: 2.5rem;
            }

            .modal-actions {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 0 1rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .page-subtitle {
                font-size: 1.1rem;
            }

            .cart-header-modern {
                padding: 1.5rem;
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .cart-summary-modern {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-modern"></div>
    </div>

    <!-- Modal de Confirmação -->
    <div class="confirmation-modal" id="confirmationModal">
        <div class="modal-content-modern">
            <div class="modal-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="modal-title">Confirmar Remoção</h3>
            <p class="modal-message">Tem certeza que deseja remover este produto do carrinho?</p>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="hideConfirmationModal()">Cancelar</button>
                <button class="modal-btn modal-btn-confirm" onclick="confirmRemoval()">Sim, Remover</button>
            </div>
        </div>
    </div>

    @include('partials.navbar')

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Meu Carrinho</h1>
            <p class="page-subtitle">Revise seus produtos antes de finalizar a compra</p>
        </div>

        <!-- Container do carrinho -->
        <div class="cart-container-modern" id="cartContainer">
            <div class="cart-header-modern">
                <h2 class="cart-title-modern">
                    <i class="fas fa-shopping-cart"></i>
                    Itens no Carrinho
                </h2>
                <span class="cart-badge-modern" id="cartBadge">0 itens</span>
            </div>

            <!-- Itens do carrinho -->
            <div class="cart-items-modern" id="cartItemsContainer">
                <!-- Itens serão carregados via JavaScript -->
            </div>

            <!-- Resumo do carrinho -->
            <div class="cart-summary-modern" id="cartSummary">
                <div class="summary-row-modern">
                    <span class="summary-label-modern">Subtotal</span>
                    <span class="summary-value-modern" id="subtotalValue">R$ 0,00</span>
                </div>

                <div class="summary-row-modern">
                    <span class="summary-label-modern">Frete</span>
                    <span class="summary-value-modern">Grátis</span>
                </div>

                <div class="summary-row-modern summary-total-modern">
                    <span class="total-label-modern">Total</span>
                    <span class="total-value-modern" id="totalValue">R$ 0,00</span>
                </div>

                <button class="checkout-btn-modern" id="checkoutBtn">
                    <i class="fas fa-lock"></i>
                    Finalizar Compra
                </button>
            </div>

            <!-- Carrinho vazio -->
            <div class="empty-cart-modern" id="emptyCart">
                <div class="empty-icon-modern">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="empty-title-modern">Seu carrinho está vazio</h3>
                <p class="empty-text-modern">Adicione alguns produtos incríveis ao seu carrinho e comece a aproveitar as melhores ofertas!</p>
                <a href="{{ route('produtos.index') }}" class="continue-btn-modern">
                    <i class="fas fa-shopping-bag"></i>
                    Continuar Comprando
                </a>
            </div>
        </div>

        <!-- Continuar comprando -->
        <div class="continue-shopping-modern" id="continueShopping">
            <a href="{{ route('produtos.index') }}" class="continue-link-modern">
                <i class="fas fa-arrow-left"></i>
                Continuar comprando
            </a>
        </div>
    </div>

    @include('partials.footer')
    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
    <script>
        let productToRemove = null;
        let carrinhoData = @json($carrinho ?? []);
        let isAuthenticated = true; // Sempre true pois o backend já fez a verificação

        // Inicializar a página
        document.addEventListener('DOMContentLoaded', function() {
            initializePage();
        });

        function initializePage() {
            if (carrinhoData.length > 0) {
                renderCartItems();
                document.getElementById('emptyCart').style.display = 'none';
                document.getElementById('cartSummary').style.display = 'block';
                document.getElementById('continueShopping').classList.add('show');
            } else {
                document.getElementById('emptyCart').classList.add('show');
                document.getElementById('cartSummary').style.display = 'none';
                document.getElementById('continueShopping').style.display = 'none';
            }
        }

        function renderCartItems() {
            const container = document.getElementById('cartItemsContainer');
            container.innerHTML = '';

            carrinhoData.forEach(item => {
                const itemTotal = item.preco * item.quantidade;
                const itemElement = `
                    <div class="cart-item-modern" data-item-id="${item.id}" id="cartItem-${item.id}">
                        <img src="${item.imagem}" alt="${item.nome}" class="item-image-modern">
                        <div class="item-details-modern">
                            <h3 class="item-name-modern">${item.nome}</h3>
                            <div class="item-price-modern">
                                <i class="fas fa-tag"></i>
                                R$ ${item.preco.toFixed(2).replace('.', ',')}
                            </div>
                        </div>
                        <div class="item-quantity-modern">
                            <button class="quantity-btn-modern" onclick="decreaseQuantity(${item.id})">-</button>
                            <input type="number" class="quantity-input-modern" value="${item.quantidade}" min="1" id="quantity-${item.id}">
                            <button class="quantity-btn-modern" onclick="increaseQuantity(${item.id})">+</button>
                        </div>
                        <div class="item-total-modern" id="itemTotal-${item.id}">
                            R$ ${itemTotal.toFixed(2).replace('.', ',')}
                        </div>
                        <button class="item-remove-modern" onclick="showConfirmationModal(${item.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                container.innerHTML += itemElement;
            });

            // Atualizar totais
            updateCartTotals();
        }

        function updateCartTotals() {
            let total = 0;
            carrinhoData.forEach(item => {
                total += item.preco * item.quantidade;
            });

            document.getElementById('subtotalValue').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
            document.getElementById('totalValue').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
            document.getElementById('cartBadge').textContent = `${carrinhoData.length} ${carrinhoData.length === 1 ? 'item' : 'itens'}`;
        }

        function showLoading() {
            document.getElementById('loadingOverlay').classList.add('show');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.remove('show');
        }

        function showConfirmationModal(productId) {
            productToRemove = productId;
            document.getElementById('confirmationModal').classList.add('show');
        }

        function hideConfirmationModal() {
            document.getElementById('confirmationModal').classList.remove('show');
            productToRemove = null;
        }

        function confirmRemoval() {
            if (productToRemove) {
                removeItem(productToRemove);
            }
            hideConfirmationModal();
        }

        function increaseQuantity(productId) {
            let input = document.getElementById('quantity-' + productId);
            input.value = parseInt(input.value) + 1;
            updateQuantity(productId, input.value);
        }

        function decreaseQuantity(productId) {
            let input = document.getElementById('quantity-' + productId);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateQuantity(productId, input.value);
            }
        }

        function updateQuantity(productId, quantity) {
            showLoading();

            fetch(`/carrinho/atualizar/${productId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    quantidade: parseInt(quantity)
                })
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }
                if (!response.ok) {
                    throw new Error('Erro na resposta do servidor');
                }
                return response.json();
            })
            .then(data => {
                hideLoading();
                if (data.success) {
                    // Atualizar dados locais
                    const itemIndex = carrinhoData.findIndex(item => item.id == productId);
                    if (itemIndex !== -1) {
                        carrinhoData[itemIndex].quantidade = parseInt(quantity);
                    }

                    // Atualizar interface
                    const itemTotalElement = document.getElementById(`itemTotal-${productId}`);
                    if (itemTotalElement) {
                        const item = carrinhoData.find(item => item.id == productId);
                        if (item) {
                            itemTotalElement.textContent = `R$ ${(item.preco * item.quantidade).toFixed(2).replace('.', ',')}`;
                        }
                    }

                    updateCartTotals();
                    showToast('Sucesso!', 'Quantidade atualizada com sucesso!', 'success');
                } else {
                    showToast('Erro!', 'Não foi possível atualizar a quantidade.', 'error');
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Erro:', error);
                showToast('Erro!', 'Ocorreu um erro ao atualizar a quantidade.', 'error');
            });
        }

        function removeItem(productId) {
            showLoading();

            fetch(`/carrinho/remover/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }
                if (!response.ok) {
                    throw new Error('Erro na resposta do servidor');
                }
                return response.json();
            })
            .then(data => {
                hideLoading();
                if (data.success) {
                    // Remover item dos dados locais
                    carrinhoData = carrinhoData.filter(item => item.id != productId);

                    // Remover elemento visual
                    const itemElement = document.getElementById(`cartItem-${productId}`);
                    if (itemElement) {
                        itemElement.style.transition = 'all 0.3s ease';
                        itemElement.style.opacity = '0';
                        itemElement.style.transform = 'translateX(100px)';

                        setTimeout(() => {
                            itemElement.remove();
                            updateCartTotals();

                            // Mostrar carrinho vazio se necessário
                            if (carrinhoData.length === 0) {
                                document.getElementById('emptyCart').classList.add('show');
                                document.getElementById('cartSummary').style.display = 'none';
                                document.getElementById('continueShopping').style.display = 'none';
                            }
                        }, 300);
                    }

                    showToast('Sucesso!', 'Produto removido do carrinho!', 'success');
                } else {
                    showToast('Erro!', data.message || 'Não foi possível remover o produto.', 'error');
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Erro:', error);
                showToast('Erro!', 'Ocorreu um erro ao remover o produto.', 'error');
            });
        }

        // Função para mostrar notificação toast
        function showToast(title, message, type = 'success') {
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'toast-container';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
            `;

            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        // Event listeners para inputs de quantidade
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('quantity-input-modern')) {
                e.target.addEventListener('change', function() {
                    if (this.value < 1) this.value = 1;
                    const productId = this.id.replace('quantity-', '');
                    updateQuantity(productId, this.value);
                });
            }
        });

        // Fechar modal ao clicar fora
        document.getElementById('confirmationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideConfirmationModal();
            }
        });

        // Fechar modal com ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideConfirmationModal();
            }
        });

        // Botão finalizar compra
        document.getElementById('checkoutBtn').addEventListener('click', function() {
            if (carrinhoData.length === 0) {
                showToast('Atenção!', 'Seu carrinho está vazio.', 'error');
                return;
            }
            showToast('Sucesso!', 'Compra finalizada com sucesso!', 'success');
            // Aqui você pode adicionar a lógica de finalização de compra
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>