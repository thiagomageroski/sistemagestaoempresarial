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

        /* Conteúdo Principal */
        .main-content {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        /* Cart Container */
        .cart-container-modern {
            background: white;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
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

        /* Cart Items */
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
        }

        .item-image-modern {
            width: 120px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            margin-right: 2rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
        }

        .quantity-input-modern {
            width: 60px;
            text-align: center;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 0.6rem;
            margin: 0 0.8rem;
            font-weight: 600;
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
        }

        /* Cart Summary */
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
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .checkout-btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
            color: white;
        }

        /* Empty Cart */
        .empty-cart-modern {
            text-align: center;
            padding: 4rem 2rem;
            display: none;
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
        }

        /* Continue Shopping */
        .continue-shopping-modern {
            text-align: center;
            margin-top: 3rem;
            display: none;
        }

        .continue-link-modern {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1rem 2rem;
            border: 2px solid var(--accent-color);
            border-radius: 12px;
        }

        /* Modal de Confirmação */
        .confirmation-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
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
        }

        .modal-btn-cancel {
            background: #e2e8f0;
            color: var(--text-dark);
        }

        .modal-btn-confirm {
            background: #ef4444;
            color: white;
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
        }

        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .spinner-modern {
            width: 50px;
            height: 50px;
            border: 3px solid #f0f0f0;
            border-top: 3px solid var(--accent-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Animações */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
                max-height: 200px;
            }

            to {
                opacity: 0;
                transform: translateX(100%);
                max-height: 0;
                padding: 0;
                margin: 0;
                border: none;
            }
        }

        .removing {
            animation: slideOut 0.5s ease forwards !important;
            overflow: hidden;
        }

        /* Toast */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 10000;
            border-left: 4px solid var(--success-color);
        }

        .toast.error {
            border-left-color: #ef4444;
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
            <h3 class="modal-title">Confirmar Remoção</h3>
            <p class="modal-message">Tem certeza que deseja remover este produto do carrinho?</p>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="hideConfirmationModal()">Cancelar</button>
                <button class="modal-btn modal-btn-confirm" onclick="confirmRemoval()">Sim, Remover</button>
            </div>
        </div>
    </div>

    @include('partials.navbar')

    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Meu Carrinho</h1>
            <p class="page-subtitle">Revise seus produtos antes de finalizar a compra</p>
        </div>

        <div class="cart-container-modern">
            <div class="cart-header-modern">
                <h2 class="cart-title-modern">
                    <i class="fas fa-shopping-cart"></i>
                    Itens no Carrinho
                </h2>
                <span class="cart-badge-modern" id="cartBadge">
                    {{ count($carrinho) }} {{ count($carrinho) === 1 ? 'item' : 'itens' }}
                </span>
            </div>

            <div class="cart-items-modern" id="cartItemsContainer">
                @if(count($carrinho) > 0)
                    @foreach($carrinho as $item)
                        <div class="cart-item-modern" data-item-id="{{ $item['id'] }}" id="cartItem-{{ $item['id'] }}">
                            <img src="{{ asset('storage/' . $item['imagem']) }}" alt="{{ $item['nome'] }}"
                                class="item-image-modern">
                            <div class="item-details-modern">
                                <h3 class="item-name-modern">{{ $item['nome'] }}</h3>
                                <div class="item-price-modern">
                                    <i class="fas fa-tag"></i>
                                    R$ {{ number_format($item['preco'], 2, ',', '.') }}
                                </div>
                            </div>
                            <div class="item-quantity-modern">
                                <button class="quantity-btn-modern" onclick="decreaseQuantity({{ $item['id'] }})">-</button>
                                <input type="number" class="quantity-input-modern" value="{{ $item['quantidade'] }}" min="1"
                                    id="quantity-{{ $item['id'] }}">
                                <button class="quantity-btn-modern" onclick="increaseQuantity({{ $item['id'] }})">+</button>
                            </div>
                            <div class="item-total-modern" id="itemTotal-{{ $item['id'] }}">
                                R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}
                            </div>
                            <button class="item-remove-modern" onclick="showConfirmationModal({{ $item['id'] }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>

            @if(count($carrinho) > 0)
                <div class="cart-summary-modern" id="cartSummary">
                    <div class="summary-row-modern">
                        <span class="summary-label-modern">Subtotal</span>
                        <span class="summary-value-modern" id="subtotalValue">R$
                            {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                    <div class="summary-row-modern">
                        <span class="summary-label-modern">Frete</span>
                        <span class="summary-value-modern">Grátis</span>
                    </div>
                    <div class="summary-row-modern summary-total-modern">
                        <span class="total-label-modern">Total</span>
                        <span class="total-value-modern" id="totalValue">R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="checkout-btn-modern" id="checkoutBtn">
                        <i class="fas fa-lock"></i>
                        Finalizar Compra
                    </a>
                </div>
            @endif

            <div class="empty-cart-modern" id="emptyCart"
                style="{{ count($carrinho) > 0 ? 'display: none;' : 'display: block;' }}">
                <div class="empty-icon-modern">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="empty-title-modern">Seu carrinho está vazio</h3>
                <p class="empty-text-modern">Adicione alguns produtos incríveis ao seu carrinho!</p>
                <a href="{{ route('produtos.index') }}" class="continue-btn-modern">
                    <i class="fas fa-shopping-bag"></i>
                    Continuar Comprando
                </a>
            </div>
        </div>

        @if(count($carrinho) > 0)
            <div class="continue-shopping-modern" id="continueShopping" style="display: block;">
                <a href="{{ route('produtos.index') }}" class="continue-link-modern">
                    <i class="fas fa-arrow-left"></i>
                    Continuar comprando
                </a>
            </div>
        @endif
    </div>

    @include('partials.footer')

    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
    <script>
        let productToRemove = null;
        let carrinhoData = {};

        // Inicializar carrinhoData com os dados do PHP
        @foreach($carrinho as $item)
            carrinhoData[{{ $item['id'] }}] = @json($item);
        @endforeach

        console.log('Dados do carrinho:', carrinhoData);

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
            const input = document.getElementById('quantity-' + productId);
            let newQuantity = parseInt(input.value) + 1;
            input.value = newQuantity;

            // Atualizar imediatamente a interface
            updateItemTotal(productId, newQuantity);

            // Fazer a requisição para o servidor
            updateQuantity(productId, newQuantity);
        }

        function decreaseQuantity(productId) {
            const input = document.getElementById('quantity-' + productId);
            let newQuantity = parseInt(input.value) - 1;

            if (newQuantity < 1) newQuantity = 1;

            input.value = newQuantity;

            // Atualizar imediatamente a interface
            updateItemTotal(productId, newQuantity);

            // Fazer a requisição para o servidor
            updateQuantity(productId, newQuantity);
        }

        function updateItemTotal(productId, quantity) {
            if (carrinhoData[productId]) {
                const preco = carrinhoData[productId].preco;
                const total = preco * quantity;

                const itemTotalElement = document.getElementById('itemTotal-' + productId);
                if (itemTotalElement) {
                    itemTotalElement.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
                }

                // Atualizar o total geral temporariamente
                updateTotalTemporarily();
            }
        }

        function updateTotalTemporarily() {
            let subtotal = 0;

            // Calcular subtotal baseado nos dados locais
            for (const productId in carrinhoData) {
                const input = document.getElementById('quantity-' + productId);
                if (input) {
                    const quantidade = parseInt(input.value);
                    subtotal += carrinhoData[productId].preco * quantidade;
                }
            }

            // Atualizar os totais na interface
            const subtotalElement = document.getElementById('subtotalValue');
            const totalElement = document.getElementById('totalValue');

            if (subtotalElement) {
                subtotalElement.textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');
            }

            if (totalElement) {
                totalElement.textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');
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
                        // Atualizar os dados locais
                        if (carrinhoData[productId]) {
                            carrinhoData[productId].quantidade = parseInt(quantity);
                        }

                        // Atualizar os totais com os dados do servidor
                        updateTotalCompleto(data.total);

                        showToast('Quantidade atualizada com sucesso!', 'success');
                    } else {
                        // Reverter a mudança se falhar
                        const input = document.getElementById('quantity-' + productId);
                        if (input && carrinhoData[productId]) {
                            input.value = carrinhoData[productId].quantidade;
                            updateItemTotal(productId, carrinhoData[productId].quantidade);
                        }
                        showToast('Erro ao atualizar quantidade!', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    console.error('Erro:', error);
                    // Reverter a mudança se falhar
                    const input = document.getElementById('quantity-' + productId);
                    if (input && carrinhoData[productId]) {
                        input.value = carrinhoData[productId].quantidade;
                        updateItemTotal(productId, carrinhoData[productId].quantidade);
                    }
                    showToast('Erro ao atualizar quantidade!', 'error');
                });
        }

        function updateTotalCompleto(total) {
            const subtotalElement = document.getElementById('subtotalValue');
            const totalElement = document.getElementById('totalValue');

            if (subtotalElement) {
                subtotalElement.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
            }

            if (totalElement) {
                totalElement.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
            }
        }

        function removeItem(productId) {
            showLoading();

            const itemElement = document.getElementById('cartItem-' + productId);
            if (itemElement) {
                itemElement.classList.add('removing');
            }

            fetch(`/carrinho/remover/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            })
                .then(response => response.json())
                .then(data => {
                    hideLoading();
                    if (data.success) {
                        setTimeout(() => {
                            if (itemElement) {
                                itemElement.remove();
                            }
                            // Remover do objeto carrinhoData
                            delete carrinhoData[productId];

                            // Atualizar a UI completa
                            updateCartUI(data.carrinho, data.total);

                            showToast('Produto removido com sucesso!', 'success');
                        }, 500);
                    } else {
                        if (itemElement) {
                            itemElement.classList.remove('removing');
                        }
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    if (itemElement) {
                        itemElement.classList.remove('removing');
                    }
                    showToast('Erro ao remover produto', 'error');
                });
        }

        function updateCartUI(carrinhoData, total) {
            const cartBadge = document.getElementById('cartBadge');
            const emptyCart = document.getElementById('emptyCart');
            const cartSummary = document.getElementById('cartSummary');
            const continueShopping = document.getElementById('continueShopping');

            const itemCount = Object.keys(carrinhoData).length;

            if (cartBadge) {
                cartBadge.textContent = `${itemCount} ${itemCount === 1 ? 'item' : 'itens'}`;
            }

            if (itemCount === 0) {
                emptyCart.style.display = 'block';
                cartSummary.style.display = 'none';
                if (continueShopping) continueShopping.style.display = 'none';
            } else {
                emptyCart.style.display = 'none';
                cartSummary.style.display = 'block';
                if (continueShopping) continueShopping.style.display = 'block';

                // Atualizar totais
                updateTotalCompleto(total);
            }
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        // Event listener para mudanças manuais no input
        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('quantity-input-modern')) {
                let quantity = parseInt(e.target.value);
                if (isNaN(quantity) || quantity < 1) {
                    quantity = 1;
                    e.target.value = 1;
                }

                const productId = e.target.id.replace('quantity-', '');
                updateItemTotal(productId, quantity);
                updateQuantity(productId, quantity);
            }
        });

        // Fechar modal ao clicar fora
        document.getElementById('confirmationModal').addEventListener('click', function (e) {
            if (e.target === this) {
                hideConfirmationModal();
            }
        });

        // Fechar modal com ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                hideConfirmationModal();
            }
        });

        // Inicializar a página
        document.addEventListener('DOMContentLoaded', function () {
            // Garantir que os valores iniciais estão corretos
            for (const productId in carrinhoData) {
                const input = document.getElementById('quantity-' + productId);
                if (input) {
                    input.value = carrinhoData[productId].quantidade;
                }
            }
        });
    </script>
</body>

</html>