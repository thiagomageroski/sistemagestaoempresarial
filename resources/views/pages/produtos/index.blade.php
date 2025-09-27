<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #4895ef;
            --secondary-color: #7209b7;
            --success-color: #06d6a0;
            --warning-color: #ffd166;
            --danger-color: #ef476f;
            --dark-color: #2d3142;
            --light-color: #f8f9fa;
            --gray-light: #e9ecef;
            --text-muted: #6c757d;
            --border-radius: 16px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --nav-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf1 100%);
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Minimalista */
        .navbar-minimalista {
            background: linear-gradient(135deg, #3a0ca3 0%, #4361ee 100%);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.6rem 0;
            z-index: 1000;
            position: relative;
        }

        .navbar-brand-minimal {
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .navbar-brand-minimal i {
            color: #4cc9f0;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem;
            border-radius: 10px;
        }

        .nav-item-minimal {
            margin: 0 0.3rem;
        }

        .nav-link-minimal {
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 0.6rem 1rem !important;
            border-radius: 8px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 500;
            position: relative;
        }

        .nav-link-minimal:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.12);
            transform: translateY(-1px);
        }

        .nav-link-minimal.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-link-minimal i {
            width: 20px;
            text-align: center;
            font-size: 0.95rem;
        }

        .navbar-toggler-minimal {
            border: none;
            color: white !important;
            padding: 0.4rem 0.7rem;
        }

        .navbar-toggler-minimal:focus {
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.25);
        }

        .btn-nav-minimal {
            padding: 0.4rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s ease;
        }

        .btn-nav-minimal i {
            font-size: 0.9rem;
        }

        /* Conteúdo Principal */
        .container {
            max-width: 1200px;
            padding: 2rem 1.5rem;
            flex: 1;
        }

        /* Header da página */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease;
        }

        .page-title {
            font-weight: 800;
            color: var(--dark-color);
            margin: 0;
            font-size: 2.2rem;
            position: relative;
            padding-left: 2rem;
        }

        .page-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 80%;
            width: 6px;
            background: linear-gradient(to bottom, var(--primary-color), var(--primary-dark));
            border-radius: 10px;
        }

        /* Barra de busca */
        .search-container {
            display: flex;
            gap: 0.75rem;
            background: white;
            padding: 0.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .search-container:focus-within {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            transform: translateY(-2px);
        }

        .search-input {
            border: none;
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            font-size: 1rem;
            min-width: 280px;
            background: var(--light-color);
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            background: white;
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .search-input::placeholder {
            placeholder: "Buscar produtos...";
        }

        .search-btn {
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
            background: linear-gradient(to right, var(--primary-dark), var(--primary-color));
        }

        /* Alertas */
        .alert {
            border: none;
            border-radius: var(--border-radius);
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            animation: slideIn 0.5s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-warning {
            background: linear-gradient(135deg, var(--warning-color), #ffb74d);
            color: var(--dark-color);
        }

        .alert i {
            font-size: 1.5rem;
        }

        /* Grid de produtos */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 1.5rem;
        }

        /* Card de produto */
        .product-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
            animation: fadeInUp 0.6s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 2;
        }

        .product-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-category {
            color: var(--primary-color);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .product-price {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--dark-color);
            margin: 0.5rem 0 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .price-currency {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .product-action {
            margin-top: auto;
        }

        .btn-primary {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition);
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
            background: linear-gradient(to right, var(--primary-dark), var(--primary-color));
        }

        /* Estados vazios */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
            grid-column: 1 / -1;
            display: none;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: var(--gray-light);
            opacity: 0.5;
        }

        .empty-state h3 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: var(--text-muted);
        }

        /* Filtros adicionais */
        .filters-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
        }

        .filter-label {
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.9rem;
        }

        .filter-select {
            border: none;
            background: var(--light-color);
            padding: 0.5rem;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .filter-select:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        /* Badge de contador do carrinho - REMOVIDO */
        .cart-count-badge {
            display: none !important;
        }

        .nav-cart-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .nav-link-cart {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        /* Ícone de Carrinho Flutuante */
        .cart-icon-floating {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 3;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            opacity: 0;
            transform: scale(0.8);
        }

        .product-card:hover .cart-icon-floating {
            opacity: 1;
            transform: scale(1);
        }

        .cart-icon-floating:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            transform: scale(1.1) !important;
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }

        .cart-icon-floating.added {
            background: linear-gradient(135deg, var(--success-color), #06b48e);
            animation: bounce 0.6s ease;
        }

        /* Toast de notificação */
        .cart-toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            border-left: 4px solid var(--success-color);
        }

        .cart-toast.show {
            transform: translateX(0);
        }

        .cart-toast i {
            color: var(--success-color);
            font-size: 1.2rem;
        }

        .cart-toast-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .cart-toast-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--dark-color);
        }

        .cart-toast-message {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
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

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 4px 12px rgba(239, 71, 111, 0.3);
            }

            50% {
                transform: scale(1.1);
                box-shadow: 0 6px 16px rgba(239, 71, 111, 0.4);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 4px 12px rgba(239, 71, 111, 0.3);
            }
        }

        .product-card {
            animation: fadeInUp 0.6s ease;
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .search-container {
                width: 100%;
            }

            .search-input {
                min-width: auto;
                flex: 1;
            }
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }

            .page-title {
                font-size: 1.8rem;
                padding-left: 1.5rem;
            }

            .container {
                padding: 1.5rem 1rem;
            }

            .filters-container {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .products-grid {
                grid-template-columns: 1fr;
            }

            .product-image {
                height: 200px;
            }

            .search-btn span {
                display: none;
            }

            .search-btn {
                padding: 0.75rem;
            }

            .page-title {
                font-size: 1.6rem;
                padding-left: 1.2rem;
            }

            .page-title::before {
                width: 4px;
            }
        }

        /* Efeitos de loading */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <div class="container">
        <!-- Cabeçalho com busca -->
        <div class="page-header">
            <h1 class="page-title">Produtos</h1>
            <div class="search-container">
                <input type="search" class="search-input" placeholder="Buscar produtos..." aria-label="Buscar">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                    <span>Buscar</span>
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="filters-container">
            <div class="filter-group">
                <span class="filter-label">Categoria:</span>
                <select class="filter-select" id="category-filter">
                    <option value="all">Todas</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria }}">{{ $categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label">Ordenar por:</span>
                <select class="filter-select" id="sort-filter">
                    <option value="recent">Mais recentes</option>
                    <option value="price-low">Menor preço</option>
                    <option value="price-high">Maior preço</option>
                    <option value="popular">Mais populares</option>
                </select>
            </div>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Grid de produtos -->
        <div class="products-grid" id="products-container">
            @foreach($produtos as $produto)
                <div class="product-card" data-category="{{ $produto['categoria'] }}" data-price="{{ $produto['preco'] }}"
                    data-popularity="{{ $produto['destaque'] ? 5 : 3 }}">
                    <div class="product-image">
                        <img src="{{ $produto['imagem'] }}" alt="{{ $produto['nome'] }}">
                        @if($produto['destaque'])
                            <div class="product-badge">Destaque</div>
                        @endif
                        <!-- FORMULÁRIO CORRETO PARA ADICIONAR AO CARRINHO -->
                        <form action="{{ route('carrinho.adicionar') }}" method="POST" class="cart-form">
                            @csrf
                            <input type="hidden" name="produto_id" value="{{ $produto['id'] }}">
                            <input type="hidden" name="quantidade" value="1">
                            <button type="submit" class="cart-icon-floating">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </form>
                    </div>
                    <div class="product-body">
                        <h5 class="product-title">{{ $produto['nome'] }}</h5>
                        <p class="product-category">
                            <i class="fas fa-tag"></i> {{ $produto['categoria'] }}
                        </p>
                        <p class="product-price">
                            <span class="price-currency">R$</span> {{ number_format($produto['preco'], 2, ',', '.') }}
                        </p>
                        <div class="product-action">
                            <a href="{{ route('produtos.show', $produto['slug']) }}" class="btn-primary">
                                <i class="fas fa-eye"></i> Ver detalhes
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Estado vazio -->
        <div class="empty-state" id="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>Nenhum produto encontrado</h3>
            <p>Tente ajustar os filtros ou termos de busca.</p>
            <button class="btn-primary" id="reset-filters">
                <i class="fas fa-sync"></i> Limpar Filtros
            </button>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para adicionar produto ao carrinho (agora usando formulário)
        function addToCart(event, element) {
            event.preventDefault(); // Previne o comportamento padrão do formulário

            const form = element.closest('form');
            const productId = form.querySelector('input[name="produto_id"]').value;
            const productName = element.closest('.product-card').querySelector('.product-title').textContent;

            // Animação de feedback visual
            element.classList.add('added');
            setTimeout(() => {
                element.classList.remove('added');
            }, 1000);

            // Mostrar notificação
            showToast('Produto adicionado!', `${productName} foi adicionado ao carrinho.`);

            // Enviar o formulário - o contador será atualizado pelo backend via sessão
            form.submit();
        }

        // Função para mostrar notificação toast
        function showToast(title, message) {
            // Remover toast anterior se existir
            const existingToast = document.getElementById('cart-toast');
            if (existingToast) {
                existingToast.remove();
            }

            // Criar novo toast
            const toast = document.createElement('div');
            toast.id = 'cart-toast';
            toast.className = 'cart-toast';
            toast.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <div class="cart-toast-content">
                    <div class="cart-toast-title">${title}</div>
                    <div class="cart-toast-message">${message}</div>
                </div>
            `;

            document.body.appendChild(toast);

            // Mostrar toast
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            // Esconder toast após 3 segundos
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Script da Navbar - Destacar link ativo
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link-minimal');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }

                link.addEventListener('click', function () {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Script dos Produtos
            const searchInput = document.querySelector('.search-input');
            const categoryFilter = document.getElementById('category-filter');
            const sortFilter = document.getElementById('sort-filter');
            const productsContainer = document.getElementById('products-container');
            const productCards = document.querySelectorAll('.product-card');
            const emptyState = document.getElementById('empty-state');
            const resetFiltersBtn = document.getElementById('reset-filters');

            // Função para filtrar produtos
            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value;
                const sortBy = sortFilter.value;

                let visibleProducts = 0;

                // Filtrar produtos
                productCards.forEach(card => {
                    const title = card.querySelector('.product-title').textContent.toLowerCase();
                    const category = card.getAttribute('data-category');
                    const price = parseFloat(card.getAttribute('data-price'));
                    const popularity = parseInt(card.getAttribute('data-popularity'));

                    // Verificar se o produto corresponde aos critérios de busca e filtro
                    const matchesSearch = title.includes(searchTerm);
                    const matchesCategory = selectedCategory === 'all' || category === selectedCategory;

                    if (matchesSearch && matchesCategory) {
                        card.style.display = 'flex';
                        visibleProducts++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Ordenar produtos
                if (sortBy !== 'recent') {
                    const visibleCards = Array.from(productCards).filter(card => card.style.display !== 'none');

                    visibleCards.sort((a, b) => {
                        const aPrice = parseFloat(a.getAttribute('data-price'));
                        const bPrice = parseFloat(b.getAttribute('data-price'));
                        const aPopularity = parseInt(a.getAttribute('data-popularity'));
                        const bPopularity = parseInt(b.getAttribute('data-popularity'));

                        switch (sortBy) {
                            case 'price-low':
                                return aPrice - bPrice;
                            case 'price-high':
                                return bPrice - aPrice;
                            case 'popular':
                                return bPopularity - aPopularity;
                            default:
                                return 0;
                        }
                    });

                    // Reordenar os produtos no DOM
                    visibleCards.forEach(card => {
                        productsContainer.appendChild(card);
                    });
                }

                // Mostrar ou esconder estado vazio
                if (visibleProducts === 0) {
                    emptyState.style.display = 'block';
                } else {
                    emptyState.style.display = 'none';
                }
            }

            // Event listeners
            searchInput.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);
            sortFilter.addEventListener('change', filterProducts);

            // Botão para limpar filtros
            resetFiltersBtn.addEventListener('click', function () {
                searchInput.value = '';
                categoryFilter.value = 'all';
                sortFilter.value = 'recent';
                filterProducts();
            });

            // Inicializar animações de entrada em sequência
            const cards = document.querySelectorAll('.product-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            });

            // Inicializar a filtragem
            filterProducts();

            // Adicionar evento de clique para os botões "Ver detalhes"
            document.querySelectorAll('.cart-icon-floating').forEach(icon => {
                icon.addEventListener('click', function (e) {
                    addToCart(e, this);
                });
            });

            // Adicionar evento de clique para os ícones do carrinho
            document.querySelectorAll('.cart-icon-floating').forEach(icon => {
                icon.addEventListener('click', function (e) {
                    addToCart(e, this);
                });
            });
        });
    </script>
</body>

</html>