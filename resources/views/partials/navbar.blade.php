<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Elegante - SGE Sistema</title>
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
            --border-radius-lg: 20px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --nav-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
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

        .content {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Navbar Estilizada */
        .custom-navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%) !important;
            box-shadow: var(--nav-shadow);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Brand Logo */
        .navbar-brand {
            font-weight: 800 !important;
            font-size: 1.8rem !important;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
        }

        .navbar-brand::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            opacity: 0;
            transition: var(--transition);
        }

        .navbar-brand:hover::before {
            opacity: 1;
        }

        .navbar-brand i {
            color: var(--success-color);
            font-size: 2rem;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .navbar-brand:hover i {
            transform: scale(1.1) rotate(5deg);
        }

        /* Nav Items */
        .navbar-nav {
            gap: 0.5rem;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.75rem 1.25rem !important;
            border-radius: var(--border-radius);
            transition: var(--transition);
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--success-color);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .nav-link:hover::before {
            width: 80%;
        }

        .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .nav-link.active::before {
            width: 80%;
            background: var(--warning-color);
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .btn-light-custom {
            background: linear-gradient(135deg, white, #f8f9fa) !important;
            color: var(--primary-dark) !important;
            border: none;
            border-radius: var(--border-radius);
            padding: 0.6rem 1.25rem !important;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
        }

        .btn-light-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
            background: linear-gradient(135deg, #f8f9fa, white) !important;
        }

        .btn-outline-light-custom {
            background: transparent !important;
            color: white !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: var(--border-radius);
            padding: 0.5rem 1.25rem !important;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-outline-light-custom:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        /* Toggler Button */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            transition: var(--transition);
        }

        .navbar-toggler:hover .navbar-toggler-icon {
            transform: scale(1.1);
        }

        /* Mobile Menu */
        .navbar-collapse {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            border-radius: var(--border-radius);
            margin-top: 1rem;
            padding: 1rem;
            box-shadow: var(--card-shadow);
        }

        /* Admin Badge */
        .admin-badge {
            background: linear-gradient(135deg, var(--success-color), var(--success-dark));
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 0.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(6, 214, 160, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(6, 214, 160, 0);
            }
        }

        /* Notification Dot */
        .nav-notification {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: var(--danger-color);
            border-radius: 50%;
            animation: ping 1.5s infinite;
        }

        @keyframes ping {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(2);
                opacity: 0.5;
            }
        }

        /* Dropdown Menu (para futuras implementações) */
        .dropdown-menu {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 0.5rem;
        }

        .dropdown-item {
            color: white;
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        /* Search Bar (opcional) */
        .navbar-search {
            position: relative;
            margin-right: 1rem;
        }

        .search-input {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1rem 0.6rem 3rem;
            color: white;
            width: 250px;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .navbar-nav {
                gap: 0.25rem;
            }
            
            .nav-link {
                padding: 0.75rem 1rem !important;
            }
            
            .search-input {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .navbar-container {
                padding: 0 1rem;
            }
            
            .navbar-brand {
                font-size: 1.6rem !important;
            }
            
            .navbar-brand i {
                font-size: 1.8rem;
            }
            
            .search-input {
                width: 100%;
                margin-bottom: 1rem;
            }
            
            .auth-buttons {
                margin-top: 1rem;
                justify-content: center;
            }
            
            .navbar-collapse {
                margin-top: 0.5rem;
                padding: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.4rem !important;
                padding: 0.4rem 0.8rem;
            }
            
            .nav-link {
                padding: 0.6rem 0.8rem !important;
                font-size: 0.95rem;
            }
            
            .btn-light-custom,
            .btn-outline-light-custom {
                padding: 0.5rem 1rem !important;
                font-size: 0.9rem;
            }
        }

        /* Animações */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .custom-navbar {
            animation: slideInDown 0.5s ease;
        }

        /* Efeito de glassmorphism */
        .custom-navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            z-index: -1;
        }

        /* Melhorias de acessibilidade */
        .nav-link:focus,
        .btn-light-custom:focus,
        .btn-outline-light-custom:focus {
            outline: 2px solid rgba(255, 255, 255, 0.5);
            outline-offset: 2px;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .nav-link {
                border: 1px solid transparent;
            }
            
            .nav-link:hover,
            .nav-link.active {
                border: 1px solid white;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Elegante -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="navbar-container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-chart-line"></i>
                SGE
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <!-- Search Bar (Opcional) -->
                <div class="navbar-search me-3 d-none d-lg-block">
                    <i class="fas fa-search search-icon"></i>
                    <input type="search" class="search-input" placeholder="Buscar..." aria-label="Buscar">
                </div>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home"></i>
                            Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-box"></i>
                            Produtos
                            <span class="nav-notification"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-info-circle"></i>
                            Sobre
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user-plus"></i>
                            Cadastro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i>
                            Admin
                            <span class="admin-badge">Pro</span>
                        </a>
                    </li>
                </ul>

                <div class="auth-buttons">
                    <a href="#" class="btn btn-light-custom">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                    <form action="#" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-outline-light-custom">
                            <i class="fas fa-sign-out-alt"></i>
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo de exemplo -->
    <div class="content">
        <div class="alert alert-info">
            <strong>Navbar Demonstrativa:</strong> Esta é uma demonstração visual da navbar elegante do SGE Sistema.
        </div>
        
        <h1>Conteúdo Principal</h1>
        <p>Scroll para ver o comportamento sticky da navbar...</p>
        
        <div style="height: 200vh"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Adicionar classe active ao clicar nos links
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Efeito de scroll na navbar
            let lastScrollY = window.scrollY;
            const navbar = document.querySelector('.custom-navbar');
            
            window.addEventListener('scroll', () => {
                if (lastScrollY < window.scrollY) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }
                lastScrollY = window.scrollY;
            });

            // Animação de digitação no brand (efeito opcional)
            const brandText = document.querySelector('.navbar-brand');
            const originalText = brandText.textContent;
            
            function typeEffect() {
                let i = 0;
                brandText.textContent = '';
                
                function type() {
                    if (i < originalText.length) {
                        brandText.textContent += originalText.charAt(i);
                        i++;
                        setTimeout(type, 100);
                    }
                }
                type();
            }

            // Descomente a linha abaixo para ativar o efeito de digitação
            // typeEffect();
        });
    </script>
</body>
</html>