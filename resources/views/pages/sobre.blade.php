<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - SGE Sistema de Gestão</title>
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
            max-width: 1000px;
            padding: 3rem 1.5rem;
        }

        /* Header da página */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeIn 0.8s ease;
        }

        .page-title {
            font-weight: 800;
            font-size: 3rem;
            color: var(--dark-color);
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
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            border-radius: 2px;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Conteúdo principal */
        .about-content {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--card-shadow);
            padding: 3rem;
            margin-bottom: 3rem;
            animation: slideInUp 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        .about-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color), var(--success-color));
            border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
        }

        .intro-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--dark-color);
            margin-bottom: 2.5rem;
            text-align: center;
            position: relative;
            padding: 0 2rem;
        }

        .intro-text::before,
        .intro-text::after {
            content: '"';
            font-size: 3rem;
            color: var(--primary-light);
            position: absolute;
            opacity: 0.3;
        }

        .intro-text::before {
            top: -1rem;
            left: 0;
        }

        .intro-text::after {
            bottom: -2rem;
            right: 0;
        }

        /* Lista de características */
        .features-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background: var(--light-color);
            border-radius: var(--border-radius);
            transition: var(--transition);
            border-left: 4px solid transparent;
        }

        .feature-item:hover {
            transform: translateX(10px);
            box-shadow: var(--card-shadow);
            border-left-color: var(--primary-color);
            background: white;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .feature-item:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-content {
            flex: 1;
        }

        .feature-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .feature-description {
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Seção de arquitetura */
        .architecture-section {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid var(--gray-light);
        }

        .section-title {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--dark-color);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .architecture-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .architecture-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            text-align: center;
            border-top: 4px solid var(--primary-color);
        }

        .architecture-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .architecture-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
            transition: var(--transition);
        }

        .architecture-card:hover .architecture-icon {
            transform: scale(1.1);
        }

        .architecture-title {
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .architecture-description {
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Call to Action */
        .cta-section {
            text-align: center;
            margin-top: 4rem;
            padding: 3rem 2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: var(--border-radius-lg);
            color: white;
            animation: fadeIn 1s ease;
        }

        .cta-title {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .cta-text {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-button {
            background: white;
            color: var(--primary-color);
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            background: var(--light-color);
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

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Decorações */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .element-1 {
            top: 20%;
            left: 10%;
            font-size: 4rem;
            color: var(--primary-color);
            animation-delay: 0s;
        }

        .element-2 {
            top: 60%;
            right: 15%;
            font-size: 3rem;
            color: var(--secondary-color);
            animation-delay: 2s;
        }

        .element-3 {
            bottom: 20%;
            left: 20%;
            font-size: 5rem;
            color: var(--success-color);
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                padding: 2rem 1rem;
            }
            
            .page-title {
                font-size: 2.2rem;
            }
            
            .about-content {
                padding: 2rem 1.5rem;
            }
            
            .intro-text {
                font-size: 1.1rem;
                padding: 0 1rem;
            }
            
            .feature-item {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            .feature-icon {
                margin: 0 auto;
            }
            
            .architecture-grid {
                grid-template-columns: 1fr;
            }
            
            .cta-section {
                padding: 2rem 1.5rem;
            }
            
            .cta-title {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .page-subtitle {
                font-size: 1rem;
            }
            
            .about-content {
                padding: 1.5rem 1rem;
            }
            
            .feature-item {
                padding: 1.25rem;
            }
            
            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }
            
            .architecture-card {
                padding: 1.5rem;
            }
            
            .architecture-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .cta-button {
                width: 100%;
                justify-content: center;
            }
        }

        /* Melhorias de acessibilidade */
        .feature-item:focus-within {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        .cta-button:focus {
            outline: 2px solid white;
            outline-offset: 2px;
        }

        /* Efeitos de foco suaves */
        *:focus {
            outline: 2px solid var(--primary-light);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabeçalho -->
        <div class="page-header">
            <h1 class="page-title">Sobre o SGE</h1>
            <p class="page-subtitle">Conheça a arquitetura e as características do nosso sistema de gestão empresarial</p>
        </div>

        <!-- Conteúdo Principal -->
        <div class="about-content">
            <div class="floating-elements">
                <i class="fas fa-code floating-element element-1"></i>
                <i class="fas fa-database floating-element element-2"></i>
                <i class="fas fa-rocket floating-element element-3"></i>
            </div>

            <p class="intro-text">
                Este projeto demonstra uma base completa de um sistema de gestão empresarial em Laravel,
                com camadas MVC, componentes Blade e Bootstrap via NPM.
            </p>

            <ul class="features-list">
                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Arquitetura MVC com rotas funcionais</h3>
                        <p class="feature-description">
                            Estrutura organizada seguindo o padrão Model-View-Controller com sistema de rotas completo
                            e bem definido para uma manutenção simplificada.
                        </p>
                    </div>
                </li>

                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-puzzle-piece"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Layouts, partials e components reutilizáveis</h3>
                        <p class="feature-description">
                            Sistema modular com componentes Blade reutilizáveis, partials organizados e layouts
                            consistentes para desenvolvimento ágil e padronizado.
                        </p>
                    </div>
                </li>

                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-memory"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Sem banco de dados (dados simulados em memória)</h3>
                        <p class="feature-description">
                            Funcionalidade completa sem dependência de banco de dados, utilizando dados simulados
                            para demonstração e desenvolvimento inicial.
                        </p>
                    </div>
                </li>

                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">Pronto para evoluir com Models e Migrations</h3>
                        <p class="feature-description">
                            Base sólida preparada para implementação completa de Models Eloquent, migrations de banco
                            e todas as funcionalidades Laravel avançadas quando desejar.
                        </p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Seção de Arquitetura -->
        <div class="architecture-section">
            <h2 class="section-title">Arquitetura do Sistema</h2>
            
            <div class="architecture-grid">
                <div class="architecture-card">
                    <div class="architecture-icon">
                        <i class="fas fa-code-branch"></i>
                    </div>
                    <h3 class="architecture-title">Frontend Moderno</h3>
                    <p class="architecture-description">
                        Bootstrap 5 via NPM, componentes Blade reutilizáveis e design system consistente.
                    </p>
                </div>

                <div class="architecture-card">
                    <div class="architecture-icon">
                        <i class="fas fa-server"></i>
                    </div>
                    <h3 class="architecture-title">Backend Laravel</h3>
                    <p class="architecture-description">
                        Framework PHP robusto com arquitetura MVC e todas as melhores práticas.
                    </p>
                </div>

                <div class="architecture-card">
                    <div class="architecture-icon">
                        <i class="fas fa-plug"></i>
                    </div>
                    <h3 class="architecture-title">Pronto para Escalar</h3>
                    <p class="architecture-description">
                        Estrutura preparada para integração com banco de dados e APIs quando necessário.
                    </p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="cta-section">
            <h2 class="cta-title">Pronto para Começar?</h2>
            <p class="cta-text">
                Explore todas as funcionalidades do SGE e descubra como nosso sistema pode transformar
                a gestão do seu negócio.
            </p>
            <button class="cta-button">
                <i class="fas fa-play-circle"></i>
                Começar Agora
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animações de entrada em sequência
            const featureItems = document.querySelectorAll('.feature-item');
            featureItems.forEach((item, index) => {
                item.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            });

            const architectureCards = document.querySelectorAll('.architecture-card');
            architectureCards.forEach((card, index) => {
                card.style.animationDelay = `${0.3 + (index * 0.1)}s`;
            });

            // Interação com os itens
            featureItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(10px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });

        });
    </script>
</body>
</html>