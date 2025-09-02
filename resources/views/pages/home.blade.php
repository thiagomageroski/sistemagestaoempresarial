<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - SGE Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --border-radius-lg: 24px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --hero-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
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

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--hero-shadow);
            overflow: hidden;
            position: relative;
            margin-bottom: 4rem;
            animation: fadeIn 0.8s ease;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="80" cy="80" r="1" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 4rem 2rem;
            text-align: center;
            color: white;
        }

        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: slideInUp 0.8s ease;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            opacity: 0.9;
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            animation: slideInUp 1s ease;
        }

        .hero-cta {
            animation: slideInUp 1.2s ease;
        }

        .btn-hero {
            background: linear-gradient(135deg, var(--success-color), var(--success-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 1.25rem 2.5rem;
            font-weight: 600;
            font-size: 1.2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.3);
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }

        .btn-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(6, 214, 160, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-hero:hover::before {
            left: 100%;
        }

        /* Features Section */
        .features-section {
            margin-bottom: 3rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
            animation: fadeInUp 0.6s ease;
            position: relative;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            opacity: 0;
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 2rem auto 1.5rem;
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.2);
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-content {
            padding: 0 2rem 2rem;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .feature-title {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .feature-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            margin-top: auto;
        }

        .feature-link:hover {
            color: var(--primary-dark);
            transform: translateX(5px);
        }

        /* Decorative Elements */
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            background: var(--success-color);
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 60px;
            height: 60px;
            background: var(--warning-color);
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            background: var(--danger-color);
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
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

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem 1rem;
            }
            
            .hero-content {
                padding: 3rem 1.5rem;
            }
            
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .btn-hero {
                padding: 1rem 2rem;
                font-size: 1.1rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .feature-card {
                max-width: 400px;
                margin: 0 auto;
            }
        }

        @media (max-width: 576px) {
            .hero-content {
                padding: 2rem 1rem;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .btn-hero {
                width: 100%;
                justify-content: center;
            }
            
            .feature-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }
            
            .feature-title {
                font-size: 1.2rem;
            }
        }

        /* Efeitos especiais */
        .hero-section {
            position: relative;
            overflow: hidden;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        /* Acessibilidade */
        .btn-hero:focus {
            outline: 2px solid white;
            outline-offset: 4px;
        }

        .feature-card:focus-within {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
            
            <div class="hero-content">
                <h1 class="hero-title">SGE: Sistema de gestão empresarial</h1>
                <p class="hero-subtitle">
                    Organize vendas, estoque e financeiro em um único lugar com nossa plataforma intuitiva e poderosa.
                </p>
                <div class="hero-cta">
                    <a href="/produtos" class="btn-hero">
                        <i class="fas fa-rocket"></i>
                        Explorar Produtos
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-section" id="features">
            <div class="features-grid">
                <!-- Feature 1 -->
                <div class="feature-card" style="animation-delay: 0.1s">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Gestão Financeira Avançada</h3>
                        <p class="feature-description">
                            Controle completo do seu fluxo de caixa, relatórios detalhados e análise de desempenho financeiro em tempo real.
                        </p>
                        <a href="/produtos" class="feature-link">
                            Saiba mais <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card" style="animation-delay: 0.2s">
                    <div class="feature-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Controle de Estoque Inteligente</h3>
                        <p class="feature-description">
                            Gerencie seu inventário com alertas automáticos, controle de entradas/saídas e integração com vendas.
                        </p>
                        <a href="/produtos" class="feature-link">
                            Saiba mais <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card" style="animation-delay: 0.3s">
                    <div class="feature-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Vendas e PDV Integrado</h3>
                        <p class="feature-description">
                            Sistema completo de vendas com emissão de NFC-e, controle de comissões e gestão de clientes.
                        </p>
                        <a href="/produtos" class="feature-link">
                            Saiba mais <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card" style="animation-delay: 0.4s">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Gestão de Clientes</h3>
                        <p class="feature-description">
                            CRM integrado com histórico de compras, fidelização e comunicação multicanal com seus clientes.
                        </p>
                        <a href="/produtos" class="feature-link">
                            Saiba mais <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card" style="animation-delay: 0.5s">
                    <div class="feature-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Relatórios Personalizados</h3>
                        <p class="feature-description">
                            Crie relatórios personalizados, dashboards interativos e tome decisões baseadas em dados concretos.
                        </p>
                        <a href="/produtos" class="feature-link">
                            Saiba mais <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card" style="animation-delay: 0.6s">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Acesso Multiplataforma</h3>
                        <p class="feature-description">
                            Acesse seu sistema de qualquer dispositivo, com aplicativos nativos para iOS, Android e versão web.
                        </p>
                        <a href="/produtos" class="feature-link">
                            Saiba mais <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animações de entrada em sequência
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach((card, index) => {
                card.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            });

            // Efeito de hover nos cards
            featureCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                    this.style.boxShadow = 'var(--card-shadow-hover)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'var(--card-shadow)';
                });
            });

            // Interação com o botão CTA
            const ctaButton = document.querySelector('.btn-hero');
            ctaButton.addEventListener('click', function(e) {
                // Não é mais necessário pois agora é um link
                // A navegação será tratada naturalmente pelo navegador
            });
        });
    </script>
</body>
</html>