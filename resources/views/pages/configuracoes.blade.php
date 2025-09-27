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

        /* Novos estilos para as seções adicionadas */
        .notification-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .notification-type {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            background-color: var(--bg-secondary);
        }

        .notification-type-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .notification-type-title {
            font-weight: 600;
            margin: 0;
            color: var(--text-primary);
        }

        .privacy-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .privacy-option {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            background-color: var(--bg-secondary);
        }

        .privacy-option-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .privacy-option-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .privacy-option-title {
            font-weight: 600;
            margin: 0;
            color: var(--text-primary);
        }

        .privacy-option-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .account-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .account-info-card {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            background-color: var(--bg-secondary);
        }

        .account-info-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .account-info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .account-info-title {
            font-weight: 600;
            margin: 0;
            color: var(--text-primary);
        }

        .accessibility-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .accessibility-option {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            background-color: var(--bg-secondary);
        }

        .accessibility-option-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .accessibility-option-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .accessibility-option-title {
            font-weight: 600;
            margin: 0;
            color: var(--text-primary);
        }

        .accessibility-option-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .advanced-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .advanced-option {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            background-color: var(--bg-secondary);
        }

        .advanced-option-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .advanced-option-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .advanced-option-title {
            font-weight: 600;
            margin: 0;
            color: var(--text-primary);
        }

        .advanced-option-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1rem;
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
    @include("partials.navbar")

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
                            <div class="switch-description">Habilita transições e efeitos suaves</div>
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

                <!-- Seção de Notificações -->
                <div id="notificacoes" class="settings-section" style="display: none;">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h2 class="section-title">Notificações</h2>
                    </div>
                    
                    <p class="section-description">
                        Gerencie como e quando você recebe notificações do sistema.
                    </p>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Notificações por Email</div>
                            <div class="switch-description">Receba notificações importantes por email</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Notificações Push</div>
                            <div class="switch-description">Receba notificações mesmo quando não estiver usando o sistema</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Som de Notificação</div>
                            <div class="switch-description">Reproduzir som quando novas notificações chegarem</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <h4 style="margin-top: 2.5rem;">Tipos de Notificação</h4>
                    <div class="notification-types">
                        <div class="notification-type">
                            <div class="notification-type-header">
                                <div class="switch-label">Atividades do Sistema</div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="switch-description">Notificações sobre atualizações, manutenção e outras atividades do sistema</div>
                        </div>

                        <div class="notification-type">
                            <div class="notification-type-header">
                                <div class="switch-label">Atividades de Usuários</div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="switch-description">Notificações sobre atividades de outros usuários relevantes para você</div>
                        </div>

                        <div class="notification-type">
                            <div class="notification-type-header">
                                <div class="switch-label">Lembretes e Prazos</div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="switch-description">Lembretes de tarefas pendentes e prazos próximos</div>
                        </div>

                        <div class="notification-type">
                            <div class="notification-type-header">
                                <div class="switch-label">Promoções e Novidades</div>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="switch-description">Notificações sobre novos recursos e promoções</div>
                        </div>
                    </div>
                </div>

                <!-- Seção de Privacidade -->
                <div id="privacidade" class="settings-section" style="display: none;">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h2 class="section-title">Privacidade</h2>
                    </div>
                    
                    <p class="section-description">
                        Controle como suas informações são coletadas e utilizadas no sistema.
                    </p>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Coleta de Dados de Uso</div>
                            <div class="switch-description">Permitir que o sistema colete dados anônimos de uso para melhorias</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Perfil Público</div>
                            <div class="switch-description">Tornar seu perfil visível para outros usuários do sistema</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Compartilhamento de Dados com Terceiros</div>
                            <div class="switch-description">Permitir que dados anônimos sejam compartilhados com parceiros para melhorar a experiência</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <h4 style="margin-top: 2.5rem;">Configurações de Privacidade</h4>
                    <div class="privacy-options">
                        <div class="privacy-option">
                            <div class="privacy-option-header">
                                <div class="privacy-option-icon">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div>
                                    <div class="privacy-option-title">Visibilidade do Perfil</div>
                                    <div class="privacy-option-description">Quem pode ver suas informações de perfil</div>
                                </div>
                            </div>
                            <select class="form-control">
                                <option>Somente eu</option>
                                <option selected>Usuários do sistema</option>
                                <option>Público</option>
                            </select>
                        </div>

                        <div class="privacy-option">
                            <div class="privacy-option-header">
                                <div class="privacy-option-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div>
                                    <div class="privacy-option-title">Indexação por Motores de Busca</div>
                                    <div class="privacy-option-description">Permitir que seu perfil apareça em resultados de busca</div>
                                </div>
                            </div>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="privacy-option">
                            <div class="privacy-option-header">
                                <div class="privacy-option-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div>
                                    <div class="privacy-option-title">Retenção de Dados</div>
                                    <div class="privacy-option-description">Por quanto tempo manter seus dados após desativação da conta</div>
                                </div>
                            </div>
                            <select class="form-control">
                                <option>30 dias</option>
                                <option selected>90 dias</option>
                                <option>1 ano</option>
                                <option>Indefinidamente</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Seção de Conta -->
                <div id="conta" class="settings-section" style="display: none;">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <h2 class="section-title">Conta</h2>
                    </div>
                    
                    <p class="section-description">
                        Gerencie as configurações da sua conta e informações pessoais.
                    </p>

                    <h4>Informações Pessoais</h4>
                    <div class="form-group">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control">
                        <div class="form-text">Seu endereço de email principal para comunicação</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Telefone</label>
                        <input type="tel" class="form-control">
                    </div>

                    <h4 style="margin-top: 2.5rem;">Alterar Senha</h4>
                    <div class="form-group">
                        <label class="form-label">Senha Atual</label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nova Senha</label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirmar Nova Senha</label>
                        <input type="password" class="form-control">
                    </div>

                    <h4 style="margin-top: 2.5rem;">Informações da Conta</h4>
                    <div class="account-info">
                        <div class="account-info-card">
                            <div class="account-info-header">
                                <div class="account-info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="account-info-title">Data de Criação</div>
                            </div>
                            <p>15 de Março, 2023</p>
                        </div>

                        <div class="account-info-card">
                            <div class="account-info-header">
                                <div class="account-info-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="account-info-title">Status da Conta</div>
                            </div>
                            <p>Verificada <i class="fas fa-check-circle text-success ms-1"></i></p>
                        </div>

                        <div class="account-info-card">
                            <div class="account-info-header">
                                <div class="account-info-icon">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div class="account-info-title">Tipo de Usuário</div>
                            </div>
                            <p>Administrador</p>
                        </div>
                    </div>

                    <div class="setting-switch" style="margin-top: 2rem;">
                        <div class="switch-info">
                            <div class="switch-label">Autenticação de Dois Fatores (2FA)</div>
                            <div class="switch-description">Adicione uma camada extra de segurança à sua conta</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Seção de Acessibilidade -->
                <div id="acessibilidade" class="settings-section" style="display: none;">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-universal-access"></i>
                        </div>
                        <h2 class="section-title">Acessibilidade</h2>
                    </div>
                    
                    <p class="section-description">
                        Ajuste o sistema para melhor atender às suas necessidades de acessibilidade.
                    </p>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Alto Contraste</div>
                            <div class="switch-description">Aumenta o contraste entre elementos para melhor legibilidade</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Modo Daltonismo</div>
                            <div class="switch-description">Ajusta as cores para melhor distinção por usuários daltônicos</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Leitor de Tela</div>
                            <div class="switch-description">Otimiza a interface para uso com leitores de tela</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <h4 style="margin-top: 2.5rem;">Configurações de Texto</h4>
                    <div class="accessibility-options">
                        <div class="accessibility-option">
                            <div class="accessibility-option-header">
                                <div class="accessibility-option-icon">
                                    <i class="fas fa-text-height"></i>
                                </div>
                                <div class="accessibility-option-title">Tamanho do Texto</div>
                            </div>
                            <div class="accessibility-option-description">Ajuste o tamanho padrão do texto no sistema</div>
                            <select class="form-control">
                                <option>Pequeno</option>
                                <option selected>Médio</option>
                                <option>Grande</option>
                                <option>Extra Grande</option>
                            </select>
                        </div>

                        <div class="accessibility-option">
                            <div class="accessibility-option-header">
                                <div class="accessibility-option-icon">
                                    <i class="fas fa-font"></i>
                                </div>
                                <div class="accessibility-option-title">Fonte</div>
                            </div>
                            <div class="accessibility-option-description">Escolha uma fonte mais legível</div>
                            <select class="form-control">
                                <option selected>Padrão do Sistema</option>
                                <option>Arial</option>
                                <option>Verdana</option>
                                <option>Open Dyslexic</option>
                            </select>
                        </div>

                        <div class="accessibility-option">
                            <div class="accessibility-option-header">
                                <div class="accessibility-option-icon">
                                    <i class="fas fa-mouse-pointer"></i>
                                </div>
                                <div class="accessibility-option-title">Tamanho do Cursor</div>
                            </div>
                            <div class="accessibility-option-description">Aumente o tamanho do cursor para melhor visibilidade</div>
                            <select class="form-control">
                                <option>Pequeno</option>
                                <option selected>Médio</option>
                                <option>Grande</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Seção Avançado -->
                <div id="avancado" class="settings-section" style="display: none;">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h2 class="section-title">Avançado</h2>
                    </div>
                    
                    <p class="section-description">
                        Configurações avançadas para usuários experientes. Use com cautela.
                    </p>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Modo Desenvolvedor</div>
                            <div class="switch-description">Ativa ferramentas e opções para desenvolvedores</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Logs Detalhados</div>
                            <div class="switch-description">Registra informações detalhadas sobre o uso do sistema</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="setting-switch">
                        <div class="switch-info">
                            <div class="switch-label">Cache de Dados</div>
                            <div class="switch-description">Armazena dados localmente para melhor desempenho</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <h4 style="margin-top: 2.5rem;">Configurações Avançadas</h4>
                    <div class="advanced-options">
                        <div class="advanced-option">
                            <div class="advanced-option-header">
                                <div class="advanced-option-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="advanced-option-title">Limpar Cache</div>
                            </div>
                            <div class="advanced-option-description">Remove todos os dados armazenados localmente</div>
                            <button class="btn-settings btn-secondary mt-2" style="width: 100%;">
                                <i class="fas fa-trash-alt"></i>
                                Limpar Agora
                            </button>
                        </div>

                        <div class="advanced-option">
                            <div class="advanced-option-header">
                                <div class="advanced-option-icon">
                                    <i class="fas fa-download"></i>
                                </div>
                                <div class="advanced-option-title">Exportar Dados</div>
                            </div>
                            <div class="advanced-option-description">Baixe uma cópia de todos os seus dados</div>
                            <button class="btn-settings btn-secondary mt-2" style="width: 100%;">
                                <i class="fas fa-file-export"></i>
                                Exportar Dados
                            </button>
                        </div>

                        <div class="advanced-option">
                            <div class="advanced-option-header">
                                <div class="advanced-option-icon">
                                    <i class="fas fa-redo-alt"></i>
                                </div>
                                <div class="advanced-option-title">Redefinir Configurações</div>
                            </div>
                            <div class="advanced-option-description">Restaura todas as configurações para os valores padrão</div>
                            <button class="btn-settings btn-secondary mt-2" style="width: 100%;">
                                <i class="fas fa-undo"></i>
                                Redefinir Tudo
                            </button>
                        </div>
                    </div>

                    <h4 style="margin-top: 2.5rem;">Zona de Perigo</h4>
                    <div class="advanced-option border-danger">
                        <div class="advanced-option-header">
                            <div class="advanced-option-icon bg-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="advanced-option-title text-danger">Desativar Conta</div>
                        </div>
                        <div class="advanced-option-description">Desativa sua conta permanentemente. Esta ação não pode ser desfeita.</div>
                        <button class="btn-settings mt-2" style="width: 100%; background: var(--danger-color); color: white;">
                            <i class="fas fa-user-slash"></i>
                            Desativar Minha Conta
                        </button>
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
    @include("partials.footer")

    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
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

            // Salvar configurações
            const saveButton = document.querySelector('.btn-primary');
            saveButton.addEventListener('click', function() {
                // Coletar todas as configurações
                const settings = {
                    theme: document.documentElement.getAttribute('data-theme'),
                    // Adicione mais configurações aqui conforme necessário
                };
                
                // Salvar no localStorage (em um sistema real, enviaria para o servidor)
                localStorage.setItem('userSettings', JSON.stringify(settings));
                
                // Mostrar mensagem de sucesso
                alert('Configurações salvas com sucesso!');
            });
        });
    </script>
</body>
</html>