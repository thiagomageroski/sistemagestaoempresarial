<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card de Produto Elegante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #4895ef;
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Card de Produto Estilizado */
        .product-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
        }

        /* Imagem do produto */
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

        .product-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            opacity: 0;
            transform: translateX(10px);
            transition: var(--transition);
        }

        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateX(0);
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-color);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            cursor: pointer;
        }

        .action-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        /* Corpo do card */
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

        .product-rating {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }

        .rating-stars {
            color: #ffc107;
            font-size: 0.9rem;
        }

        .rating-count {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* Botão de ação */
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

        /* Estados do produto */
        .product-card.sale .product-badge {
            background: linear-gradient(135deg, var(--danger-color), #e91e63);
        }

        .product-card.new .product-badge {
            background: linear-gradient(135deg, var(--success-color), #05b387);
        }

        .product-card.out-of-stock {
            opacity: 0.7;
        }

        .product-card.out-of-stock::after {
            content: 'Esgotado';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(239, 71, 111, 0.9);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            z-index: 3;
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

        .product-card {
            animation: fadeIn 0.6s ease;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }
            
            .product-image {
                height: 200px;
            }
            
            .product-body {
                padding: 1.25rem;
            }
            
            .product-actions {
                opacity: 1;
                transform: translateX(0);
                flex-direction: row;
            }
        }

        /* Efeitos de loading (para imagens) */
        .image-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
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
    <div class="products-grid">
        <!-- Produto Normal -->
        <div class="product-card" style="animation-delay: 0.1s">
            <div class="product-image">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Fone de Ouvido Premium">
                <div class="product-badge">Popular</div>
                <div class="product-actions">
                    <button class="action-btn">
                        <i class="fas fa-heart"></i>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="product-body">
                <h5 class="product-title">Fone de Ouvido Premium com Cancelamento de Ruído</h5>
                <p class="product-category">
                    <i class="fas fa-headphones"></i> Áudio
                </p>
                <div class="product-rating">
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-count">(128)</span>
                </div>
                <p class="product-price">
                    <span class="price-currency">R$</span> 599,90
                </p>
                <div class="product-action">
                    <a href="#" class="btn-primary">
                        <i class="fas fa-shopping-cart"></i> Ver detalhes
                    </a>
                </div>
            </div>
        </div>

        <!-- Produto em Promoção -->
        <div class="product-card sale" style="animation-delay: 0.2s">
            <div class="product-image">
                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Smartwatch Inteligente">
                <div class="product-badge">-20%</div>
                <div class="product-actions">
                    <button class="action-btn">
                        <i class="fas fa-heart"></i>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="product-body">
                <h5 class="product-title">Smartwatch Inteligente com Monitor Cardíaco</h5>
                <p class="product-category">
                    <i class="fas fa-clock"></i> Wearables
                </p>
                <div class="product-rating">
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="rating-count">(256)</span>
                </div>
                <p class="product-price">
                    <span class="price-currency">R$</span> 399,90
                </p>
                <div class="product-action">
                    <a href="#" class="btn-primary">
                        <i class="fas fa-shopping-cart"></i> Ver detalhes
                    </a>
                </div>
            </div>
        </div>

        <!-- Produto Novo -->
        <div class="product-card new" style="animation-delay: 0.3s">
            <div class="product-image">
                <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Caixa de Som Bluetooth">
                <div class="product-badge">Novo</div>
                <div class="product-actions">
                    <button class="action-btn">
                        <i class="fas fa-heart"></i>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="product-body">
                <h5 class="product-title">Caixa de Som Bluetooth à Prova D'água</h5>
                <p class="product-category">
                    <i class="fas fa-music"></i> Áudio
                </p>
                <div class="product-rating">
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <span class="rating-count">(64)</span>
                </div>
                <p class="product-price">
                    <span class="price-currency">R$</span> 299,90
                </p>
                <div class="product-action">
                    <a href="#" class="btn-primary">
                        <i class="fas fa-shopping-cart"></i> Ver detalhes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Adicionando interatividade
        document.addEventListener('DOMContentLoaded', function() {
            // Favoritar produto
            document.querySelectorAll('.action-btn .fa-heart').forEach(heart => {
                heart.addEventListener('click', function(e) {
                    e.stopPropagation();
                    this.classList.toggle('fas');
                    this.classList.toggle('far');
                    this.style.color = this.classList.contains('fas') ? '#ef476f' : '';
                });
            });
            
            // Visualização rápida
            document.querySelectorAll('.action-btn .fa-eye').forEach(eye => {
                eye.addEventListener('click', function(e) {
                    e.stopPropagation();
                    alert('Visualização rápida do produto!');
                });
            });
            
            // Efeito de loading para imagens
            const images = document.querySelectorAll('.product-image img');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.style.opacity = '1';
                });
                
                // Simular loading
                if (!img.complete) {
                    img.style.opacity = '0';
                }
            });
        });
    </script>
</body>
</html>