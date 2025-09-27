<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Navbar Minimalista Modernizada */
        .navbar-minimalista {
            background: linear-gradient(135deg, #3a0ca3 0%, #4361ee 100%);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.15);
            padding: 0.7rem 0;
            width: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-container {
            max-width: 1200px;
            padding: 0 20px;
            margin: 0 auto;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand-minimal {
            font-size: 1.7rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 700;
            margin-right: 3rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .navbar-brand-minimal:hover {
            transform: translateY(-2px);
        }
        
        .navbar-brand-minimal i {
            color: #4cc9f0;
            background: rgba(255, 255, 255, 0.12);
            padding: 0.6rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .navbar-brand-minimal:hover i {
            transform: rotate(10deg);
            background: rgba(255, 255, 255, 0.2);
        }
        
        .nav-item-minimal {
            margin: 0 0.4rem;
        }
        
        .nav-link-minimal {
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 0.7rem 1.3rem !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-weight: 500;
            position: relative;
            justify-content: center;
            font-size: 1.02rem;
        }
        
        .nav-link-minimal:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        
        .nav-link-minimal.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.18);
            font-weight: 600;
        }
        
        .nav-link-minimal i {
            width: 22px;
            text-align: center;
            font-size: 1rem;
        }
        
        .navbar-toggler-minimal {
            border: none;
            color: white !important;
            padding: 0.5rem 0.8rem;
            font-size: 1.2rem;
        }
        
        .navbar-toggler-minimal:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
        }
        
        /* Botões de Autenticação - Estilo Premium */
        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-left: 1.5rem;
        }
        
        .btn-auth {
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            font-size: 1rem;
            text-decoration: none;
            border: 2px solid transparent;
        }
        
        .btn-auth i {
            font-size: 0.95rem;
        }
        
        .btn-login {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
        }
        
        .btn-login:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-signup {
            background: linear-gradient(135deg, #4cc9f0 0%, #3a86ff 100%);
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(76, 201, 240, 0.35);
        }
        
        .btn-signup:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.6s ease;
        }
        
        .btn-signup:hover {
            background: linear-gradient(135deg, #3bb5d8 0%, #2a75ff 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(76, 201, 240, 0.5);
        }
        
        .btn-signup:hover:before {
            left: 100%;
        }
        
        /* Efeito de brilho pulsante suave */
        @keyframes gentlePulse {
            0% { box-shadow: 0 4px 15px rgba(76, 201, 240, 0.35); }
            50% { box-shadow: 0 4px 20px rgba(76, 201, 240, 0.5); }
            100% { box-shadow: 0 4px 15px rgba(76, 201, 240, 0.35); }
        }
        
        .btn-signup {
            animation: gentlePulse 3s infinite;
        }
        
        .btn-signup:hover {
            animation: none;
        }
        
        .nav-link-minimal.active:after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: #4cc9f0;
            border-radius: 50%;
            box-shadow: 0 0 10px #4cc9f0;
        }
        
        .navbar-nav-centralizado {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            margin: 0 auto;
        }
        
        .profile-menu {
            position: relative;
            margin-left: 1.5rem;
        }
        
        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            min-width: 220px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            margin-top: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(-15px);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
        
        .profile-dropdown.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        
        .profile-item {
            padding: 0.9rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
            color: #495057;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f3f5;
            font-weight: 500;
        }
        
        .profile-item:last-child {
            border-bottom: none;
        }
        
        .profile-item:hover {
            background: #f8f9fa;
            color: #3a0ca3;
            padding-left: 1.4rem;
        }
        
        .profile-item i {
            width: 20px;
            text-align: center;
            color: #6c757d;
        }
        
        .profile-item:hover i {
            color: #3a0ca3;
        }
        
        .profile-header {
            padding: 1.2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #e9ecef;
            text-align: center;
        }
        
        .profile-name {
            font-weight: 700;
            color: #3a0ca3;
            margin-bottom: 0.3rem;
            font-size: 1.1rem;
        }
        
        .profile-email {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .profile-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .profile-icon:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.08);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .navbar-actions-minimal {
            display: flex;
            align-items: center;
        }
        
        /* Badge para itens do carrinho - ESTILO MELHORADO */
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, #ef476f, #e5366a);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 2px solid #ffffff;
            box-shadow: 0 3px 10px rgba(239, 71, 111, 0.4);
            z-index: 1001;
            animation: bounceIn 0.5s ease;
        }
        
        .cart-badge.empty {
            display: none;
        }
        
        .nav-cart-container {
            position: relative;
            display: flex;
            align-items: center;
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
                box-shadow: 0 3px 10px rgba(239, 71, 111, 0.4);
            }
            50% {
                transform: scale(1.1);
                box-shadow: 0 5px 15px rgba(239, 71, 111, 0.5);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 3px 10px rgba(239, 71, 111, 0.4);
            }
        }
        
        .cart-badge.pulse {
            animation: pulse 0.6s ease;
        }
        
        @media (max-width: 992px) {
            .navbar-nav-centralizado {
                width: 100%;
                margin: 1.2rem 0;
            }
            
            .nav-item-minimal {
                margin: 0.4rem 0;
                width: 100%;
                text-align: center;
            }
            
            .nav-link-minimal {
                justify-content: center;
                padding: 0.9rem 1.5rem !important;
            }
            
            .auth-buttons {
                width: 100%;
                justify-content: center;
                flex-direction: column;
                gap: 0.8rem;
                margin: 1rem 0 0 0;
            }
            
            .btn-auth {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
            
            .profile-menu {
                width: 100%;
                margin: 1rem 0 0 0;
                display: flex;
                justify-content: center;
            }
        }
        
        @media (max-width: 768px) {
            .navbar-collapse-minimal {
                background: linear-gradient(135deg, #3a0ca3 0%, #4361ee 100%);
                padding: 1.2rem;
                border-radius: 15px;
                margin-top: 1rem;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            }
            
            .nav-link-minimal {
                padding: 1rem 1.5rem !important;
                margin: 0.3rem 0;
            }
            
            .navbar-actions-minimal {
                padding-top: 1.2rem;
                border-top: 1px solid rgba(255, 255, 255, 0.15);
                margin-top: 0.8rem;
                width: 100%;
                flex-direction: column;
            }
            
            .profile-dropdown {
                position: static;
                width: 100%;
                margin-top: 0.8rem;
                opacity: 1;
                transform: none;
                display: none;
            }
            
            .profile-dropdown.show {
                display: block;
            }
            
            .navbar-brand-minimal {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Minimalista com menu centralizado -->
    <nav class="navbar navbar-expand-lg navbar-minimalista">
        <div class="navbar-container">
            <a class="navbar-brand-minimal" href="{{ route('home') }}">
                <i class="fas fa-chart-line"></i>
                TechStore
            </a>
            
            <button class="navbar-toggler navbar-toggler-minimal" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse navbar-collapse-minimal" id="mainNav">
                <!-- Menu de navegação centralizado -->
                <ul class="navbar-nav navbar-nav-centralizado mb-2 mb-lg-0">
                    <li class="nav-item nav-item-minimal">
                        <a class="nav-link-minimal {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            Início
                        </a>
                    </li>
                    <li class="nav-item nav-item-minimal">
                        <a class="nav-link-minimal {{ request()->is('produtos*') ? 'active' : '' }}" href="{{ route('produtos.index') }}">
                            <i class="fas fa-box"></i>
                            Produtos
                        </a>
                    </li>

                    
                    <!-- Opções apenas para usuários autenticados -->
                    @if($auth)
                    <li class="nav-item nav-item-minimal">
                        <a class="nav-link-minimal {{ request()->is('minhas-compras*') ? 'active' : '' }}" href="/minhascompras">
                            <i class="fas fa-shopping-bag"></i>
                            Minhas Compras
                        </a>
                    </li>
                    <li class="nav-item nav-item-minimal">
                        <div class="nav-cart-container">
                            <a class="nav-link-minimal {{ request()->is('carrinho*') ? 'active' : '' }}" href="/carrinho">
                                <i class="fas fa-shopping-cart"></i>
                                Carrinho
                                @if(session('carrinho_count', 0) > 0)
                                    <span class="cart-badge" id="navbar-cart-count">
                                        {{ session('carrinho_count', 0) }}
                                    </span>
                                @else
                                    <span class="cart-badge empty" id="navbar-cart-count" style="display: none;"></span>
                                @endif
                            </a>
                        </div>
                    </li>
                    @endif
                </ul>

                <!-- Área de autenticação -->
                <div class="navbar-actions-minimal">
                    @if($auth)
                    <!-- Menu de perfil (apenas para usuários logados) -->
                    <div class="profile-menu">
                        <div class="profile-icon" id="profileIcon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="profile-dropdown" id="profileDropdown">
                            <div class="profile-header">
                                <div class="profile-name">{{ $user['name'] ?? '' }}</div>
                                <div class="profile-email">{{ $user['email'] ?? '' }}</div>
                            </div>
                            <a href="/perfil" class="profile-item">
                                <i class="fas fa-user-circle"></i>
                                Meu Perfil
                            </a>
                            <a href="/minhascompras" class="profile-item">
                                <i class="fas fa-shopping-bag"></i>
                                Minhas Compras
                            </a>
                            <a href="/configuracoes" class="profile-item">
                                <i class="fas fa-cog"></i>
                                Configurações
                            </a>
                            <a href="/politicas" class="profile-item">
                                <i class="fa-solid fa-scale-balanced"></i>
                                Políticas
                            </a>
                            <a href="#" class="profile-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                Sair
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @else
                    <!-- Botões de login/cadastro (apenas para usuários não logados) -->
                    <div class="auth-buttons">
                        <a href="{{ route('login') }}" class="btn-auth btn-login">
                            <i class="fas fa-sign-in-alt"></i>
                            Entrar
                        </a>
                        <a href="{{ route('cadastro') }}" class="btn-auth btn-signup">
                            <i class="fas fa-user-plus"></i>
                            Cadastrar
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo de exemplo -->
    

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
            
            // Controle do menu de perfil (apenas se o usuário estiver logado)
            const profileIcon = document.getElementById('profileIcon');
            const profileDropdown = document.getElementById('profileDropdown');
            
            if (profileIcon && profileDropdown) {
                let menuTimeout;
                
                // Abrir menu ao clicar no ícone (mobile)
                profileIcon.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        e.stopPropagation();
                        profileDropdown.classList.toggle('show');
                    }
                });
                
                // Abrir menu ao passar o mouse (desktop)
                if (window.innerWidth > 768) {
                    profileIcon.addEventListener('mouseenter', function() {
                        clearTimeout(menuTimeout);
                        profileDropdown.classList.add('show');
                    });
                    
                    // Manter menu aberto quando o mouse está sobre ele
                    profileDropdown.addEventListener('mouseenter', function() {
                        clearTimeout(menuTimeout);
                        profileDropdown.classList.add('show');
                    });
                    
                    // Fechar menu quando o mouse sai dele
                    profileDropdown.addEventListener('mouseleave', function() {
                        menuTimeout = setTimeout(function() {
                            profileDropdown.classList.remove('show');
                        }, 300);
                    });
                    
                    // Fechar menu quando o mouse sai do ícone
                    profileIcon.addEventListener('mouseleave', function() {
                        menuTimeout = setTimeout(function() {
                            if (!profileDropdown.matches(':hover')) {
                                profileDropdown.classList.remove('show');
                            }
                        }, 300);
                    });
                }
                
                // Fechar menu ao clicar fora dele
                document.addEventListener('click', function(e) {
                    if (!profileIcon.contains(e.target) && !profileDropdown.contains(e.target)) {
                        profileDropdown.classList.remove('show');
                    }
                });
                
                // Prevenir que cliques no dropdown fechem o menu
                profileDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
            
            // Função para atualizar o contador do carrinho na navbar
            window.updateNavbarCartCount = function(count) {
                const cartBadge = document.getElementById('navbar-cart-count');
                if (cartBadge) {
                    if (count > 0) {
                        cartBadge.textContent = count;
                        cartBadge.classList.remove('empty');
                        cartBadge.style.display = 'flex';
                        cartBadge.classList.add('pulse');
                        setTimeout(() => cartBadge.classList.remove('pulse'), 600);
                    } else {
                        cartBadge.classList.add('empty');
                        cartBadge.style.display = 'none';
                    }
                }
            };
            
            // Inicializar o contador do carrinho
            const initialCount = {{ session('carrinho_count', 0) }};
            updateNavbarCartCount(initialCount);
        });
        
        // Função para demonstração - alternar estado de autenticação
        function toggleAuth() {
            alert('Esta função é apenas para demonstração. No sistema real, o estado de autenticação é controlado pelo backend.');
        }
        
        // Função para visualização mobile
        function toggleMobileView() {
            const viewport = document.querySelector('meta[name="viewport"]');
            if (viewport.content === 'width=device-width, initial-scale=1.0') {
                viewport.content = 'width=375, initial-scale=1.0';
                alert('Visualização mobile ativada. Redimensione a janela para ver a responsividade.');
            } else {
                viewport.content = 'width=device-width, initial-scale=1.0';
            }
        }
    </script>
</body>
</html>