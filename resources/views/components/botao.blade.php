<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Botões Elegante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Cores principais */
            --primary-color: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #4895ef;
            
            --secondary-color: #6c757d;
            --secondary-dark: #545b62;
            --secondary-light: #8a939b;
            
            --success-color: #06d6a0;
            --success-dark: #05b387;
            --success-light: #08f7b7;
            
            --danger-color: #ef476f;
            --danger-dark: #e91e63;
            --danger-light: #f76c8b;
            
            --warning-color: #ffd166;
            --warning-dark: #ffb74d;
            --warning-light: #ffe08a;
            
            --info-color: #118ab2;
            --info-dark: #0c6991;
            --info-light: #16a9d3;
            
            --light-color: #f8f9fa;
            --dark-color: #2d3142;
            
            /* Cores neutras */
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
            
            /* Variáveis de design */
            --border-radius: 10px;
            --border-radius-sm: 6px;
            --border-radius-lg: 14px;
            
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.15);
            
            --transition: all 0.25s ease;
            --transition-slow: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--gray-800);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: var(--gray-600);
            font-size: 1.1rem;
            font-weight: 400;
        }

        .section {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--primary-color);
        }

        .button-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .group-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        /* Sistema de Botões */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            font-family: inherit;
            line-height: 1.5;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background: transparent;
        }

        .btn:focus {
            outline: 2px solid var(--primary-light);
            outline-offset: 2px;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Variantes de Cor */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
            box-shadow: var(--shadow-sm);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-color), var(--secondary-dark));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-secondary:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--secondary-dark), var(--secondary-color));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), var(--success-dark));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-success:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--success-dark), var(--success-color));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), var(--danger-dark));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-danger:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--danger-dark), var(--danger-color));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color), var(--warning-dark));
            color: var(--gray-800);
            box-shadow: var(--shadow-md);
        }

        .btn-warning:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--warning-dark), var(--warning-color));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-info {
            background: linear-gradient(135deg, var(--info-color), var(--info-dark));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-info:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--info-dark), var(--info-color));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-light {
            background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
            color: var(--gray-800);
            box-shadow: var(--shadow-sm);
        }

        .btn-light:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--gray-200), var(--gray-100));
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-dark {
            background: linear-gradient(135deg, var(--gray-800), var(--gray-900));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-dark:hover:not(:disabled) {
            background: linear-gradient(135deg, var(--gray-900), var(--gray-800));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Variantes Outline */
        .btn-outline-primary {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            box-shadow: none;
        }

        .btn-outline-primary:hover:not(:disabled) {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline-secondary {
            background: transparent;
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            box-shadow: none;
        }

        .btn-outline-secondary:hover:not(:disabled) {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Tamanhos */
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: var(--border-radius-sm);
        }

        .btn-md {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1.125rem;
            border-radius: var(--border-radius-lg);
        }

        .btn-xl {
            padding: 1.25rem 2.5rem;
            font-size: 1.25rem;
            border-radius: var(--border-radius-lg);
        }

        /* Botões com ícones */
        .btn-icon {
            width: 2.5rem;
            height: 2.5rem;
            padding: 0;
            border-radius: 50%;
        }

        .btn-icon.btn-sm {
            width: 2rem;
            height: 2rem;
        }

        .btn-icon.btn-lg {
            width: 3rem;
            height: 3rem;
        }

        /* Efeito de ripple */
        .btn-ripple {
            position: relative;
            overflow: hidden;
        }

        .btn-ripple::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 60%);
            transform: scale(0);
            opacity: 0;
            transition: transform 0.5s, opacity 1s;
        }

        .btn-ripple:active::after {
            transform: scale(2);
            opacity: 0;
            transition: 0s;
        }

        /* Estados de loading */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 1rem;
            height: 1rem;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .btn-loading.btn-sm::after {
            width: 0.875rem;
            height: 0.875rem;
        }

        .btn-loading.btn-lg::after {
            width: 1.25rem;
            height: 1.25rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Grupo de botões */
        .btn-group {
            display: inline-flex;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .btn-group .btn {
            border-radius: 0;
            margin: 0;
            box-shadow: none;
        }

        .btn-group .btn:not(:last-child) {
            border-right: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-group .btn:first-child {
            border-top-left-radius: var(--border-radius);
            border-bottom-left-radius: var(--border-radius);
        }

        .btn-group .btn:last-child {
            border-top-right-radius: var(--border-radius);
            border-bottom-right-radius: var(--border-radius);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .button-grid {
                grid-template-columns: 1fr;
            }
            
            .title {
                font-size: 2rem;
            }
            
            .section {
                padding: 1.5rem;
            }
        }

        /* Utilitários de exibição */
        .code-block {
            background: var(--gray-100);
            padding: 1rem;
            border-radius: var(--border-radius);
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
            margin-top: 1rem;
            overflow-x: auto;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            padding: 1.5rem;
            background: var(--gray-100);
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Sistema de Botões</h1>
            <p class="subtitle">Componentes de botão elegantes e totalmente personalizáveis</p>
        </div>

        <!-- Variantes de Cor -->
        <div class="section">
            <h2 class="section-title"><i class="fas fa-palette"></i> Variantes de Cor</h2>
            <div class="preview-container">
                <button class="btn btn-primary btn-md">Primary</button>
                <button class="btn btn-secondary btn-md">Secondary</button>
                <button class="btn btn-success btn-md">Success</button>
                <button class="btn btn-danger btn-md">Danger</button>
                <button class="btn btn-warning btn-md">Warning</button>
                <button class="btn btn-info btn-md">Info</button>
                <button class="btn btn-light btn-md">Light</button>
                <button class="btn btn-dark btn-md">Dark</button>
            </div>
        </div>

        <!-- Variantes Outline -->
        <div class="section">
            <h2 class="section-title"><i class="fas fa-border-style"></i> Variantes Outline</h2>
            <div class="preview-container">
                <button class="btn btn-outline-primary btn-md">Primary</button>
                <button class="btn btn-outline-secondary btn-md">Secondary</button>
            </div>
        </div>

        <!-- Tamanhos -->
        <div class="section">
            <h2 class="section-title"><i class="fas fa-arrows-alt-v"></i> Tamanhos</h2>
            <div class="preview-container">
                <button class="btn btn-primary btn-sm">Pequeno</button>
                <button class="btn btn-primary btn-md">Médio</button>
                <button class="btn btn-primary btn-lg">Grande</button>
                <button class="btn btn-primary btn-xl">Extra Grande</button>
            </div>
        </div>

        <!-- Botões com Ícones -->
        <div class="section">
            <h2 class="section-title"><i class="fas fa-icons"></i> Botões com Ícones</h2>
            <div class="preview-container">
                <button class="btn btn-primary btn-md">
                    <i class="fas fa-shopping-cart"></i> Comprar Agora
                </button>
                <button class="btn btn-success btn-md">
                    <i class="fas fa-check"></i> Confirmar
                </button>
                <button class="btn btn-danger btn-md">
                    <i class="fas fa-trash"></i> Excluir
                </button>
                <button class="btn btn-primary btn-icon btn-md">
                    <i class="fas fa-heart"></i>
                </button>
                <button class="btn btn-secondary btn-icon btn-sm">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </div>

        <!-- Estados -->
        <div class="section">
            <h2 class="section-title"><i class="fas fa-toggle-on"></i> Estados</h2>
            <div class="preview-container">
                <button class="btn btn-primary btn-md btn-loading">Carregando</button>
                <button class="btn btn-primary btn-md" disabled>Desativado</button>
                <button class="btn btn-primary btn-md btn-ripple">Efeito Ripple</button>
            </div>
        </div>

        <!-- Grupo de Botões -->
        <div class="section">
            <h2 class="section-title"><i class="fas fa-object-group"></i> Grupo de Botões</h2>
            <div class="preview-container">
                <div class="btn-group">
                    <button class="btn btn-primary btn-md">Esquerda</button>
                    <button class="btn btn-primary btn-md">Centro</button>
                    <button class="btn btn-primary btn-md">Direita</button>
                </div>
            </div>
        </div>

        <!-- Botões como Links -->
        <div class="section">
            <h2 class="section-title"><i class="fas fa-link"></i> Botões como Links</h2>
            <div class="preview-container">
                <a href="#" class="btn btn-primary btn-md">Link Primary</a>
                <a href="#" class="btn btn-success btn-md">Link Success</a>
                <a href="#" class="btn btn-outline-primary btn-md">Link Outline</a>
            </div>
        </div>
    </div>

    <script>
        // Adicionando interatividade para demonstração
        document.addEventListener('DOMContentLoaded', function() {
            // Efeito de loading
            const loadingButtons = document.querySelectorAll('.btn-loading');
            loadingButtons.forEach(btn => {
                setTimeout(() => {
                    btn.classList.remove('btn-loading');
                    btn.textContent = 'Carregamento completo';
                }, 3000);
            });
            
            // Efeito ripple
            const rippleButtons = document.querySelectorAll('.btn-ripple');
            rippleButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const x = e.offsetX;
                    const y = e.offsetY;
                    
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple-effect');
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>
</body>
</html>