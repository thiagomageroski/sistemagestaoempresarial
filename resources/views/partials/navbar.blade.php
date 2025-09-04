<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Navbar Minimalista */
        .navbar-minimalista {
            background: linear-gradient(135deg, #3a0ca3 0%, #4361ee 100%);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.6rem 0;
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
        
        /* Indicador visual para item ativo */
        .nav-link-minimal.active:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 5px;
            height: 5px;
            background: #4cc9f0;
            border-radius: 50%;
        }
        
        @media (max-width: 768px) {
            .navbar-collapse-minimal {
                background: linear-gradient(135deg, #3a0ca3 0%, #4361ee 100%);
                padding: 1rem;
                border-radius: 12px;
                margin-top: 0.8rem;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            }
            
            .nav-link-minimal {
                padding: 0.8rem 1rem !important;
                margin: 0.2rem 0;
            }
            
            .navbar-actions-minimal {
                padding-top: 1rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: 0.5rem;
            }
        }

        /* Conteúdo de exemplo para visualização */
        .demo-content {
            padding: 2rem;
            text-align: center;
            color: #495057;
        }
        
        .demo-content h2 {
            margin-bottom: 1rem;
            color: #3a0ca3;
        }
    </style>
</head>
<body>
    <!-- Navbar Minimalista com menos opções -->
    <nav class="navbar navbar-expand-lg navbar-minimalista">
        <div class="container">
            <a class="navbar-brand-minimal" href="/">
                <i class="fas fa-chart-line"></i>
                SGE
            </a>
            
            <button class="navbar-toggler navbar-toggler-minimal" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse navbar-collapse-minimal" id="mainNav">
                <!-- Apenas 3 opções principais no menu -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item nav-item-minimal">
                        <a class="nav-link-minimal" href="/">
                            <i class="fas fa-home"></i>
                            Início
                        </a>
                    </li>
                    <li class="nav-item nav-item-minimal">
                        <a class="nav-link-minimal active" href="/produtos">
                            <i class="fas fa-box"></i>
                            Produtos
                        </a>
                    </li>
                    <li class="nav-item nav-item-minimal">
                        <a class="nav-link-minimal" href="#">
                            <i class="fas fa-cog"></i>
                            Configurações
                        </a>
                    </li>
                </ul>

                <!-- Área de autenticação simplificada -->
                <div class="navbar-actions-minimal d-flex align-items-center">
                    <a href="#" class="btn btn-light btn-nav-minimal">
                        <i class="fas fa-user"></i>
                        Entrar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo de exemplo -->
    <div class="container mt-4 demo-content">
        <h2>Página de Produtos</h2>
        <p>Conteúdo da sua aplicação será exibido aqui.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script de navegação ativa
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link-minimal');
            
            // Remover classe active de todos os links
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
            
            // Adicionar classe active ao link correspondente à página atual
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>