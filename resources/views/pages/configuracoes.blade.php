<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações - Sistema de Gestão</title>
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
            --border-radius-lg: 16px;
            --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
            
            /* Novas variáveis para modo escuro */
            --bg-primary: #f8f9fa;
            --bg-secondary: #ffffff;
            --text-primary: #212529;
            --text-secondary: #495057;
            --border-color: #dee2e6;
        }

        /* Modo escuro */
        [data-theme="dark"] {
            --bg-primary: #121212;
            --bg-secondary: #1e1e1e;
            --text-primary: #f8f9fa;
            --text-secondary: #adb5bd;
            --border-color: #343a40;
            --gray-light: #2d3034;
            --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            --card-shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .settings-page {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            padding: 0;
            margin: 0;
            transition: var(--transition);
        }

        .settings-container {
            max-width: 1200px;
            padding: 2rem 1.5rem;
            margin: 0 auto;
        }

        /* Header */
        .settings-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .settings-title {
            font-weight: 800;
            color: var(--text-primary);
            margin: 0 0 1rem 0;
            font-size: 2.8rem;
            position: relative;
            display: inline-block;
        }

        .settings-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            border-radius: 10px;
        }

        .settings-subtitle {
            font-size: 1.2rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Layout de configurações */
        .settings-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
        }

        /* Sidebar de navegação */
        .settings-sidebar {
            background-color: var(--bg-secondary);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            height: fit-content;
            position: sticky;
            top: 2rem;
            transition: var(--transition);
        }

        .settings-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .settings-nav-item {
            margin-bottom: 0.5rem;
        }

        .settings-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
            font-weight: 500;
        }

        .settings-nav-link:hover,
        .settings-nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            transform: translateX(5px);
        }

        .settings-nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Conteúdo principal */
        .settings-content {
            background-color: var(--bg-secondary);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: var(--transition);
        }

        .settings-section {
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .settings-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .section-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-primary);
            margin: 0;
        }

        .section-description {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        /* Configurações de tema */
        .theme-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .theme-option {
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            background-color: var(--bg-secondary);
        }

        .theme-option:hover {
            border-color: var(--primary-color);
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }

        .theme-option.active {
            border-color: var(--primary-color);
            background: rgba(67, 97, 238, 0.05);
        }

        .theme-preview {
            width: 100%;
            height: 100px;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
        }

        .theme-light .theme-preview {
            background: linear-gradient(135deg, #f5f7fa, #e4eaf1);
            color: var(--dark-color);
            border: 1px solid var(--border-color);
        }

        .theme-dark .theme-preview {
            background: linear-gradient(135deg, #2d3142, #1a1d28);
        }

        .theme-auto .theme-preview {
            background: linear-gradient(135deg, #f5f7fa 50%, #2d3142 50%);
            position: relative;
            overflow: hidden;
        }

        .theme-auto .theme-preview::before {
            content: '🌓';
            position: absolute;
            font-size: 1.5rem;
        }

        .theme-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .theme-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Configurações de cores */
        .color-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .color-option {
            text-align: center;
            cursor: pointer;
        }

        .color-preview {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .color-option:hover .color-preview {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .color-option.active .color-preview {
            transform: scale(1.1);
            box-shadow: 0 0 0 3px var(--bg-secondary), 0 0 0 6px var(--primary-color);
        }

        .color-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-primary);
        }

        /* Switch de configurações */
        .setting-switch {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .setting-switch:last-child {
            border-bottom: none;
        }

        .switch-info {
            flex: 1;
        }

        .switch-label {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--text-primary);
        }

        .switch-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Custom switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--gray-light);
            transition: var(--transition);
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: var(--transition);
            border-radius: 50%;
        }

        input:checked + .slider {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        }

        input:checked + .slider:before {
            transform: translateX(24px);
        }

        /* Botões de ação */
        .settings-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .btn-settings {
            padding: 0.875rem 1.75rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        .btn-secondary {
            background: var(--gray-light);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            background: #dee2e6;
            transform: translateY(-2px);
        }

        /* Toggle de tema */
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: var(--transition);
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Navbar e Footer com suporte a tema */
        .navbar {
            background-color: var(--bg-secondary) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .navbar-brand, .nav-link {
            color: var(--text-primary) !important;
        }

        .navbar-toggler {
            border-color: var(--border-color);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        [data-theme="dark"] .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        footer {
            background-color: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
            transition: var(--transition);
        }

        footer a {
            color: var(--text-primary) !important;
        }

        /* Formulários */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
            color: var(--text-primary);
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: var(--bg-secondary);
            color: var(--text-primary);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .form-text {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .settings-layout {
                grid-template-columns: 1fr;
            }
            
            .settings-sidebar {
                position: static;
                margin-bottom: 2rem;
            }
            
            .settings-nav {
                display: flex;
                overflow-x: auto;
                gap: 0.5rem;
                padding-bottom: 0.5rem;
            }
            
            .settings-nav-item {
                margin-bottom: 0;
                flex-shrink: 0;
            }
            
            .settings-nav-link {
                white-space: nowrap;
            }
        }

        @media (max-width: 768px) {
            .settings-container {
                padding: 1.5rem 1rem;
            }
            
            .settings-title {
                font-size: 2.2rem;
            }
            
            .theme-options,
            .color-options {
                grid-template-columns: 1fr;
            }
            
            .settings-actions {
                flex-direction: column;
            }
            
            .btn-settings {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .settings-title {
                font-size: 1.8rem;
            }
            
            .settings-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
            
            .settings-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="settings-page">
    <!-- Navbar -->
    @include('partials.navbar')

    <div class="settings-container">
        <!-- Cabeçalho -->
        <div class="settings-header">
            <h1 class="settings-title">Configurações</h1>
            <p class="settings-subtitle">Personalize sua experiência e ajuste as preferências do sistema</p>
        </div>

        <!-- Layout principal -->
        <div class="settings-layout">
            <!-- Sidebar de navegação -->
            <div class="settings-sidebar">
                <ul class="settings-nav">
                    <li class="settings-nav-item">
                        <a href="#aparencia" class="settings-nav-link active">
                            <i class="fas fa-palette"></i>
                            Aparência
                        </a>
                    </li>
                    <li class="settings-nav-item">
                        <a href="#notificacoes" class="settings-nav-link">
                            <i class="fas fa-bell"></i>
                            Notificações
                        </a>
                    </li>
                    <li class="settings-nav-item">
                        <a href="#privacidade" class="settings-nav-link">
                            <i class="fas fa-shield-alt"></i>
                            Privacidade
                        </a>
                    </li>
                    <li class="settings-nav-item">
                        <a href="#conta" class="settings-nav-link">
                            <i class="fas fa-user-cog"></i>
                            Conta
                        </a>
                    </li>
                    <li class="settings-nav-item">
                        <a href="#acessibilidade" class="settings-nav-link">
                            <i class="fas fa-universal-access"></i>
                            Acessibilidade
                        </a>
                    </li>
                    <li class="settings-nav-item">
                        <a href="#avancado" class="settings-nav-link">
                            <i class="fas fa-cogs"></i>
                            Avançado
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Conteúdo principal -->
            <div class="settings-content">
                <!-- Seção de Aparência -->
                <div id="aparencia" class="settings-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h2 class="section-title">Aparência</h2>
                    </div>
                    
                    <p class="section-description">
                        Personalize a aparência do sistema conforme sua preferência. Alterne entre temas claro, escuro ou automático.
                    </p>

                    <!-- Seleção de Tema -->
                    <h4>Tema do Sistema</h4>
                    <div class="theme-options">
                        <div class="theme-option theme-light" data-theme="light">
                            <div class="theme-preview">Tema Claro</div>
                            <div class="theme-name">Claro</div>
                            <div class="theme-description">Interface clara e brilhante</div>
                        </div>
                        <div class="theme-option theme-dark" data-theme="dark">
                            <div class="theme-preview">Tema Escuro</div>
                            <div class="theme-name">Escuro</div>
                            <div class="theme-description">Interface escura e suave</div>
                        </div>
                        <div class="theme-option theme-auto" data-theme="auto">
                            <div class="theme-preview"></div>
                            <div class="theme-name">Automático</div>
                            <div class="theme-description">Baseado nas preferências do sistema</div>
                        </div>
                    </div>

                    <!-- Seleção de Cores -->
                    <h4 style="margin-top: 2.5rem;">Cor de Destaque</h4>
                    <div class="color-options">
                        <div class="color-option active" data-color="blue">
                            <div class="color-preview" style="background: #4361ee;">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="color-name">Azul</div>
                        </div>
                        <div class="color-option" data-color="green">
                            <div class="color-preview" style="background: #06d6a0;">
                            </div>
                            <div class="color-name">Verde</div>
                        </div>
                        <div class="color-option" data-color="purple">
                            <div class="color-preview" style="background: #7209b7;">
                            </div>
                            <div class="color-name">Roxo</div>
                        </div>
                        <div class="color-option" data-color="red">
                            <div class="color-preview" style="background: #ef476f;">
                            </div>
                            <div class="color-name">Vermelho</div>
                        </div>
                        <div class="color-option" data-color="yellow">
                            <div class="color-preview" style="background: #ffd166;">
                                <div style="color: #2d3142;"></div>
                            </div>
                            <div class="color-name">Amarelo</div>
                        </div>
                    </div>

                    <!-- Configurações adicionais -->
                    <h4 style="margin-top: 2.5rem;">Preferências de Visualização</h4>
                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Animações Suaves</div>
                            <div class="switch-description">Habilita transições and efeitos suaves</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Reduzir Movimento</div>
                            <div class="switch-description">Minimiza animações para melhor acessibilidade</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Densidade Compacta</div>
                            <div class="switch-description">Reduz o espaçamento entre elementos</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Botões de ação -->
                <div class="settings-actions">
                    <button class="btn-settings btn-secondary">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </button>
                    <button class="btn-settings btn-primary">
                        <i class="fas fa-check"></i>
                        Salvar Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Botão de toggle de tema flutuante -->
    <div class="theme-toggle" id="themeToggle">
        <i class="fas fa-moon"></i>
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar preferência de tema salva
            const savedTheme = localStorage.getItem('theme');
            const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('i');
            
            // Aplicar tema salvo ou detectar preferência do sistema
            if (savedTheme === 'dark' || (!savedTheme && prefersDarkScheme.matches)) {
                document.documentElement.setAttribute('data-theme', 'dark');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
            
            // Alternar tema
            themeToggle.addEventListener('click', function() {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                if (currentTheme === 'light') {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            });
            
            // Seleção de tema na página de configurações
            const themeOptions = document.querySelectorAll('.theme-option');
            themeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const selectedTheme = this.getAttribute('data-theme');
                    
                    // Remover classe active de todos os temas
                    themeOptions.forEach(opt => opt.classList.remove('active'));
                    
                    // Adicionar classe active ao tema selecionado
                    this.classList.add('active');
                    
                    // Aplicar o tema selecionado
                    if (selectedTheme === 'auto') {
                        if (prefersDarkScheme.matches) {
                            document.documentElement.setAttribute('data-theme', 'dark');
                            themeIcon.classList.remove('fa-moon');
                            themeIcon.classList.add('fa-sun');
                        } else {
                            document.documentElement.setAttribute('data-theme', 'light');
                            themeIcon.classList.remove('fa-sun');
                            themeIcon.classList.add('fa-moon');
                        }
                        localStorage.setItem('theme', 'auto');
                    } else {
                        document.documentElement.setAttribute('data-theme', selectedTheme);
                        localStorage.setItem('theme', selectedTheme);
                        
                        if (selectedTheme === 'dark') {
                            themeIcon.classList.remove('fa-moon');
                            themeIcon.classList.add('fa-sun');
                        } else {
                            themeIcon.classList.remove('fa-sun');
                            themeIcon.classList.add('fa-moon');
                        }
                    }
                });
                
                // Marcar o tema atual como ativo
                const currentTheme = document.documentElement.getAttribute('data-theme');
                if (option.getAttribute('data-theme') === currentTheme) {
                    option.classList.add('active');
                } else if (currentTheme === 'auto' && option.getAttribute('data-theme') === 'auto') {
                    option.classList.add('active');
                }
            });
            
            // Navegação entre seções
            const navLinks = document.querySelectorAll('.settings-nav-link');
            const sections = document.querySelectorAll('.settings-section');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove classe active de todos os links
                    navLinks.forEach(navLink => {
                        navLink.classList.remove('active');
                    });
                    
                    // Adiciona classe active ao link clicado
                    this.classList.add('active');
                    
                    // Mostra a seção correspondente
                    const targetId = this.getAttribute('href');
                    sections.forEach(section => {
                        section.style.display = 'none';
                    });
                    document.querySelector(targetId).style.display = 'block';
                });
            });
            
            // Seleção de cor
            const colorOptions = document.querySelectorAll('.color-option');
            colorOptions.forEach(option => {
                option.addEventListener('click', function() {
                    colorOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Aqui você implementaria a mudança real de cor
                    const colorName = this.querySelector('.color-name').textContent;
                    console.log('Cor selecionada:', colorName);
                });
            });
            
            // Configuração inicial - mostrar apenas a primeira seção
            sections.forEach((section, index) => {
                if (index > 0) section.style.display = 'none';
            });
            
            // Adicionar a classe active ao link da navbar
            const currentPath = window.location.pathname;
            const navLinksMain = document.querySelectorAll('.nav-link');
            
            navLinksMain.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>