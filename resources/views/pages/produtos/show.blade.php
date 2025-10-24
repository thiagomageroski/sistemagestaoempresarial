<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produto->nome }} - Sistema de Gestão</title>
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
            --success-dark: #05b387;
            --warning-color: #ffd166;
            --danger-color: #ef476f;
            --dark-color: #2d3142;
            --light-color: #f8f9fa;
            --gray-light: #e9ecef;
            --text-muted: #6c757d;
            --border-radius: 16px;
            --border-radius-lg: 20px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --image-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --transition-slow: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            padding: 2rem 1.5rem;
        }

        /* Layout principal */
        .product-detail-container {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 3rem;
            animation: fadeIn 0.8s ease;
        }

        .product-main {
            padding: 2.5rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        /* Imagem do produto */
        .product-image-container {
            position: relative;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--image-shadow);
            transition: var(--transition);
        }

        .product-image-container:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .product-badge {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .image-zoom-btn {
            position: absolute;
            bottom: 1.5rem;
            right: 1.5rem;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-color);
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .image-zoom-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        /* Informações do produto */
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .product-title {
            font-weight: 800;
            font-size: 2.5rem;
            color: var(--dark-color);
            line-height: 1.2;
            margin: 0;
        }

        .product-category {
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(67, 97, 238, 0.1);
            border-radius: 50px;
            width: fit-content;
        }

        .product-description {
            font-size: 1.1rem;
            line-height: 1.7;
            color: var(--dark-color);
            margin: 1rem 0;
        }

        .product-price-container {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin: 1.5rem 0;
        }

        .product-price {
            font-weight: 800;
            font-size: 2.8rem;
            color: var(--primary-color);
            display: flex;
            align-items: baseline;
            gap: 0.25rem;
        }

        .price-currency {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .price-installment {
            color: var(--text-muted);
            font-size: 1rem;
        }

        /* Ações do produto */
        .product-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), var(--success-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(6, 214, 160, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(6, 214, 160, 0.4);
            background: linear-gradient(135deg, var(--success-dark), var(--success-color));
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--gray-light), #dee2e6);
            color: var(--dark-color);
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            cursor: pointer;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #dee2e6, var(--gray-light));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* Detalhes adicionais */
        .product-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
            padding: 2rem;
            background: var(--light-color);
            border-radius: var(--border-radius);
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
        }

        .detail-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .detail-content h4 {
            font-weight: 600;
            margin: 0;
            font-size: 1rem;
        }

        .detail-content p {
            color: var(--text-muted);
            margin: 0.25rem 0 0 0;
        }

        /* Seção de avaliações */
        .reviews-section {
            padding: 2.5rem;
            border-top: 1px solid var(--gray-light);
        }

        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .average-rating {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
        }

        .rating-stars {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .stars-large {
            display: flex;
            gap: 0.2rem;
        }

        .stars-large i {
            color: #FFD700;
            font-size: 1.5rem;
        }

        .rating-count {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .rating-bars {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            width: 200px;
        }

        .rating-bar {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rating-bar-label {
            font-size: 0.8rem;
            width: 20px;
        }

        .rating-bar-progress {
            flex: 1;
            height: 6px;
            background: var(--gray-light);
            border-radius: 3px;
            overflow: hidden;
        }

        .rating-bar-fill {
            height: 100%;
            background: #FFD700;
            border-radius: 3px;
        }

        .add-review-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .add-review-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.3);
        }

        /* Lista de avaliações */
        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .review-card {
            background: var(--light-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            transition: var(--transition);
        }

        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .reviewer-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .reviewer-details h4 {
            font-weight: 600;
            margin: 0 0 0.25rem 0;
        }

        .review-date {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .review-rating {
            display: flex;
            gap: 0.2rem;
        }

        .review-rating i {
            color: #FFD700;
            font-size: 1rem;
        }

        .review-content {
            margin-bottom: 1rem;
        }

        .review-text {
            line-height: 1.6;
            color: var(--dark-color);
        }

        .review-helpful {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .helpful-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            transition: var(--transition);
        }

        .helpful-btn:hover {
            color: var(--primary-color);
        }

        .verified-purchase {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--success-color);
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        /* Seção de produtos relacionados */
        .related-section {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid var(--gray-light);
        }

        .section-title {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--dark-color);
            margin-bottom: 2rem;
            position: relative;
            padding-left: 1.5rem;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 80%;
            width: 5px;
            background: linear-gradient(to bottom, var(--primary-color), var(--primary-dark));
            border-radius: 10px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--gray-light);
        }

        .empty-state p {
            font-size: 1.1rem;
            margin: 0;
        }

        /* Card de produto relacionado */
        .related-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            height: 100%;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
            text-decoration: none;
            color: inherit;
        }

        .related-card-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .related-card-body {
            padding: 1.5rem;
        }

        .related-card-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .related-card-price {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--primary-color);
            margin: 0.5rem 0;
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
                transform: translateY(20px);
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

        .product-detail-container {
            animation: fadeIn 0.8s ease;
        }

        .related-card {
            animation: slideIn 0.6s ease;
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .product-main {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2rem;
            }
            
            .product-image {
                height: 350px;
            }
            
            .product-title {
                font-size: 2rem;
            }
            
            .product-price {
                font-size: 2.2rem;
            }
            
            .reviews-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem 1rem;
            }
            
            .product-main {
                padding: 1.5rem;
            }
            
            .product-actions {
                flex-direction: column;
            }
            
            .btn-success, .btn-secondary {
                width: 100%;
                justify-content: center;
            }
            
            .product-details {
                grid-template-columns: 1fr;
                padding: 1.5rem;
            }
            
            .related-grid {
                grid-template-columns: 1fr;
            }
            
            .product-title {
                font-size: 1.8rem;
            }
            
            .rating-summary {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 576px) {
            .product-image {
                height: 280px;
            }
            
            .product-badge {
                top: 1rem;
                left: 1rem;
                font-size: 0.7rem;
                padding: 0.4rem 0.8rem;
            }
            
            .image-zoom-btn {
                bottom: 1rem;
                right: 1rem;
                width: 35px;
                height: 35px;
            }
            
            .product-title {
                font-size: 1.6rem;
            }
            
            .product-price {
                font-size: 1.8rem;
            }
            
            .review-header {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Efeitos especiais */
        .product-image-container {
            position: relative;
        }

        .product-image-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, transparent 100%);
            opacity: 0;
            transition: var(--transition);
            border-radius: var(--border-radius);
        }

        .product-image-container:hover::after {
            opacity: 1;
        }

        /* Modal de zoom */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
        }

        .modal-content img {
            width: 100%;
            height: auto;
            border-radius: var(--border-radius);
        }
    </style>
</head>
<body>
    @include("partials.navbar")
    <div class="container">
        <!-- Detalhes principais do produto -->
        <div class="product-detail-container">
            <div class="product-main">
                <!-- Imagem do produto -->
                <div class="product-image-container">
                    <!-- CORREÇÃO AQUI: usando asset('storage/') -->
                    <img src="{{ asset('storage/' . $produto->imagem) }}" 
                         alt="{{ $produto->nome }}" class="product-image">
                    <!-- REMOVIDO: badge de destaque já que não temos esse campo -->
                    <button class="image-zoom-btn" onclick="openModal()">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>

                <!-- Informações do produto -->
                <div class="product-info">
                    <h1 class="product-title">{{ $produto->nome }}</h1>
                    
                    <span class="product-category">
                        <i class="fas fa-tag"></i> Geral
                    </span>

                    <p class="product-description">
                        {{ $produto->descricao }}
                    </p>

                    <div class="product-price-container">
                        <div class="product-price">
                            <span class="price-currency">R$</span> {{ number_format($produto->preco, 2, ',', '.') }}
                        </div>
                        <span class="price-installment">ou 12x de R$ {{ number_format($produto->preco / 12, 2, ',', '.') }} sem juros</span>
                    </div>

                    <div class="product-actions">
                        <form action="{{ route('carrinho.adicionar') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                            <input type="hidden" name="quantidade" value="1">
                            <button type="submit" class="btn-success">
                                <i class="fas fa-shopping-cart"></i>
                                Adicionar ao Carrinho
                            </button>
                        </form>
                        <a href="{{ route('produtos.index') }}" class="btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Voltar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Detalhes adicionais -->
            <div class="product-details">
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="detail-content">
                        <h4>Entrega Rápida</h4>
                        <p>Entrega em até 2 dias úteis</p>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="detail-content">
                        <h4>Garantia</h4>
                        <p>12 meses de garantia</p>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <div class="detail-content">
                        <h4>Devolução</h4>
                        <p>30 dias para arrependimento</p>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="detail-content">
                        <h4>Pagamento</h4>
                        <p>Parcele em até 12x</p>
                    </div>
                </div>
            </div>

            <!-- Seção de avaliações -->
            <div class="reviews-section">
                <div class="reviews-header">
                    <div class="rating-summary">
                        <div class="average-rating">4.8</div>
                        <div class="rating-stars">
                            <div class="stars-large">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <div class="rating-count">Baseado em 127 avaliações</div>
                        </div>
                        <div class="rating-bars">
                            <div class="rating-bar">
                                <span class="rating-bar-label">5</span>
                                <div class="rating-bar-progress">
                                    <div class="rating-bar-fill" style="width: 85%;"></div>
                                </div>
                                <span class="rating-bar-percent">85%</span>
                            </div>
                            <div class="rating-bar">
                                <span class="rating-bar-label">4</span>
                                <div class="rating-bar-progress">
                                    <div class="rating-bar-fill" style="width: 12%;"></div>
                                </div>
                                <span class="rating-bar-percent">12%</span>
                            </div>
                            <div class="rating-bar">
                                <span class="rating-bar-label">3</span>
                                <div class="rating-bar-progress">
                                    <div class="rating-bar-fill" style="width: 2%;"></div>
                                </div>
                                <span class="rating-bar-percent">2%</span>
                            </div>
                            <div class="rating-bar">
                                <span class="rating-bar-label">2</span>
                                <div class="rating-bar-progress">
                                    <div class="rating-bar-fill" style="width: 1%;"></div>
                                </div>
                                <span class="rating-bar-percent">1%</span>
                            </div>
                            <div class="rating-bar">
                                <span class="rating-bar-label">1</span>
                                <div class="rating-bar-progress">
                                    <div class="rating-bar-fill" style="width: 0%;"></div>
                                </div>
                                <span class="rating-bar-percent">0%</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="reviews-list">
                    <!-- Avaliação 1 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">MC</div>
                                <div class="reviewer-details">
                                    <h4>Maria Carvalho</h4>
                                    <div class="review-date">Há 2 dias</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-content">
                            <h5>Simplesmente incrível!</h5>
                            <p class="review-text">Comprei este produto há uma semana e estou maravilhada com a qualidade. A entrega foi super rápida e o produto chegou perfeitamente embalado. Superou todas as minhas expectativas! Recomendo muito.</p>
                        </div>
                        <div class="review-helpful">
                            <button class="helpful-btn">
                                <i class="fas fa-thumbs-up"></i>
                                Útil (23)
                            </button>
                            <div class="verified-purchase">
                                <i class="fas fa-check-circle"></i>
                                Compra verificada
                            </div>
                        </div>
                    </div>

                    <!-- Avaliação 2 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">JS</div>
                                <div class="reviewer-details">
                                    <h4>João Silva</h4>
                                    <div class="review-date">Há 5 dias</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-content">
                            <h5>Vale cada centavo!</h5>
                            <p class="review-text">Estou usando há um mês e o desempenho é excepcional. A qualidade de construção é impressionante e as funcionalidades atendem perfeitamente às minhas necessidades. Sem dúvida uma das melhores compras que fiz este ano.</p>
                        </div>
                        <div class="review-helpful">
                            <button class="helpful-btn">
                                <i class="fas fa-thumbs-up"></i>
                                Útil (18)
                            </button>
                            <div class="verified-purchase">
                                <i class="fas fa-check-circle"></i>
                                Compra verificada
                            </div>
                        </div>
                    </div>

                    <!-- Avaliação 3 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">AS</div>
                                <div class="reviewer-details">
                                    <h4>Ana Santos</h4>
                                    <div class="review-date">Há 1 semana</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="review-content">
                            <h5>Excelente custo-benefício</h5>
                            <p class="review-text">Comparando com outros produtos similares no mercado, este sem dúvida oferece o melhor custo-benefício. A qualidade é premium e o preço é justo. O atendimento da loja também foi impecável.</p>
                        </div>
                        <div class="review-helpful">
                            <button class="helpful-btn">
                                <i class="fas fa-thumbs-up"></i>
                                Útil (15)
                            </button>
                            <div class="verified-purchase">
                                <i class="fas fa-check-circle"></i>
                                Compra verificada
                            </div>
                        </div>
                    </div>

                    <!-- Avaliação 4 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">PO</div>
                                <div class="reviewer-details">
                                    <h4>Pedro Oliveira</h4>
                                    <div class="review-date">Há 2 semanas</div>
                                </div>
                            </div>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="review-content">
                            <h5>Superou expectativas</h5>
                            <p class="review-text">Comprei com alguma expectativa, mas o produto superou tudo! A qualidade é excelente, o design é moderno e as funcionalidades são muito intuitivas. Já indiquei para vários amigos.</p>
                        </div>
                        <div class="review-helpful">
                            <button class="helpful-btn">
                                <i class="fas fa-thumbs-up"></i>
                                Útil (31)
                            </button>
                            <div class="verified-purchase">
                                <i class="fas fa-check-circle"></i>
                                Compra verificada
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produtos relacionados -->
        @if(count($relacionados) > 0)
        <div class="related-section">
            <h2 class="section-title">Produtos Relacionados</h2>
            
            <div class="related-grid">
                @foreach($relacionados as $relacionado)
                <a href="{{ route('produtos.show', $relacionado->id) }}" class="related-card" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <!-- CORREÇÃO AQUI: usando asset('storage/') para produtos relacionados -->
                    <img src="{{ asset('storage/' . $relacionado->imagem) }}" 
                         alt="{{ $relacionado->nome }}" class="related-card-image">
                    <div class="related-card-body">
                        <h3 class="related-card-title">{{ $relacionado->nome }}</h3>
                        <div class="product-category" style="font-size: 0.9rem; padding: 0.3rem 0.8rem;">
                            <i class="fas fa-tag"></i> Geral
                        </div>
                        <div class="related-card-price">R$ {{ number_format($relacionado->preco, 2, ',', '.') }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Modal de zoom -->
    <div class="modal-overlay" id="imageModal" onclick="closeModal()">
        <div class="modal-content">
            <!-- CORREÇÃO AQUI: usando asset('storage/') no modal também -->
            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}">
        </div>
    </div>

    @include("partials.footer")
    
    <script>
        // Funções para o modal de zoom
        function openModal() {
            document.getElementById('imageModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Fechar modal com ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Adicionar animação de entrada para os cards relacionados
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.related-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            });
        });

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

        // Adicionar evento de submit para mostrar toast
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const productName = '{{ $produto->nome }}';
                showToast('Produto adicionado!', `${productName} foi adicionado ao carrinho.`);
            });
        });

        // Sistema de avaliações úteis
        document.querySelectorAll('.helpful-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const countElement = this.querySelector('span') || document.createElement('span');
                let count = parseInt(this.textContent.match(/\d+/) || 0);
                
                if (!this.classList.contains('clicked')) {
                    count++;
                    this.classList.add('clicked');
                    this.innerHTML = `<i class="fas fa-thumbs-up"></i> Útil (${count})`;
                    this.style.color = 'var(--primary-color)';
                } else {
                    count--;
                    this.classList.remove('clicked');
                    this.innerHTML = `<i class="fas fa-thumbs-up"></i> Útil (${count})`;
                    this.style.color = 'var(--text-muted)';
                }
            });
        });
    </script>
</body>
</html>