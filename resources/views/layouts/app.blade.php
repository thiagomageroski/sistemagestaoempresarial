<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGE - Sistema de Gestão Empresarial</title>
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
            --border-radius: 12px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --nav-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Estilizada */
        .navbar {
            background: linear-gradient(120deg, var(--primary-color), var(--primary-dark));
            box-shadow: var(--nav-shadow);
            padding: 0.8rem 1rem;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
            font-weight: 600;
        }

        .navbar-toggler {
            border: none;
            color: white !important;
            font-size: 1.5rem;
        }

        /* Conteúdo Principal */
        main {
            flex: 1;
            padding: 2rem 0;
        }

        .container {
            max-width: 1200px;
        }

        /* Alertas Estilizados */
        .alert {
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            animation: slideIn 0.5s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: linear-gradient(135deg, var(--success-color), #05b387);
            color: white;
        }

        .alert-warning {
            background: linear-gradient(135deg, var(--warning-color), #ffb74d);
            color: var(--dark-color);
        }

        .alert i {
            font-size: 1.5rem;
        }

        /* Footer Estilizado */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 2.5rem 0 1.5rem;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .footer-brand {
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: white;
            transform: translateY(-2px);
        }

        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        /* Animações */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Utilidades */
        .page-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid var(--primary-color);
            display: inline-block;
        }

        .card-custom {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: none;
            transition: var(--transition);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .card-header-custom {
            background: linear-gradient(120deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 1.25rem 1.5rem;
            border-bottom: none;
            font-weight: 600;
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.25rem;
            }

            .navbar-brand i {
                font-size: 1.5rem;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-links {
                justify-content: center;
                flex-wrap: wrap;
            }

            .alert {
                padding: 0.875rem 1.25rem;
            }

            .alert i {
                font-size: 1.25rem;
            }
        }

        /* Melhorias de acessibilidade */
        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5);
        }

        a:focus,
        button:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Modo escuro (opcional) */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1a1d28;
                color: #e9ecef;
            }

            .card-custom {
                background: #2d3142;
                color: #e9ecef;
            }

            .page-title {
                color: #e9ecef;
                border-bottom-color: var(--primary-light);
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
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line"></i>
                <span>SGE</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users"></i> Clientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-box"></i> Produtos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-invoice-dollar"></i> Pedidos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i> Configurações
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="py-4">
        <div class="container">
            <!-- Alertas -->
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>Operação realizada com sucesso!</span>
            </div>

            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Atenção: Alguns itens necessitam de sua revisão.</span>
            </div>

            <!-- Conteúdo da Página -->
            <h1 class="page-title">Dashboard</h1>

            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card-custom">
                        <div class="card-body-custom text-center">
                            <i class="fas fa-dollar-sign fa-2x text-success mb-3"></i>
                            <h3 class="h5">Faturamento</h3>
                            <p class="h4 fw-bold">R$ 15.847,90</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card-custom">
                        <div class="card-body-custom text-center">
                            <i class="fas fa-users fa-2x text-primary mb-3"></i>
                            <h3 class="h5">Clientes</h3>
                            <p class="h4 fw-bold">124</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card-custom">
                        <div class="card-body-custom text-center">
                            <i class="fas fa-box fa-2x text-warning mb-3"></i>
                            <h3 class="h5">Produtos</h3>
                            <p class="h4 fw-bold">56</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card-custom">
                        <div class="card-body-custom text-center">
                            <i class="fas fa-clipboard-list fa-2x text-danger mb-3"></i>
                            <h3 class="h5">Pedidos</h3>
                            <p class="h4 fw-bold">24</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <i class="fas fa-chart-line"></i>
                    <span>Sistema de Gestão Empresarial</span>
                </div>

                <div class="footer-links">
                    <a href="#"><i class="fas fa-question-circle me-1"></i> Ajuda</a>
                    <a href="#"><i class="fas fa-shield-alt me-1"></i> Privacidade</a>
                    <a href="#"><i class="fas fa-envelope me-1"></i> Contato</a>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; 2023 SGE - Sistema de Gestão Empresarial. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>

    <script>
        // Adicionando interatividade
        document.addEventListener('DOMContentLoaded', function () {
            // Fechar alertas automaticamente após 5 segundos
            setTimeout(function () {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Adicionar animação de hover nos cards
            const cards = document.querySelectorAll('.card-custom');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.1)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'var(--card-shadow)';
                });
            });
        });
    </script>
</body>

</html>