<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não Encontrada - TechStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #3a0ca3 0%, #4361ee 100%);
            --accent-color: #4cc9f0;
            --text-dark: #2d3748;
            --text-light: #718096;
            --light-bg: #f8fafc;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Navbar (mantendo o mesmo estilo) */
        .navbar-minimalista {
            background: var(--primary-gradient);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.15);
            padding: 0.7rem 0;
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
        }
        
        .navbar-brand-minimal i {
            color: #4cc9f0;
            background: rgba(255, 255, 255, 0.12);
            padding: 0.6rem;
            border-radius: 12px;
        }
        
        /* Conteúdo Principal */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .error-container {
            max-width: 800px;
            text-align: center;
            padding: 3rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
        }
        
        .error-icon {
            font-size: 6rem;
            margin-bottom: 1.5rem;
            color: var(--accent-color);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .error-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .error-subtitle {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }
        
        .error-description {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }
        
        .btn-primary-custom {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0.9rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(58, 12, 163, 0.2);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(58, 12, 163, 0.3);
            color: white;
        }
        
        .btn-outline-custom {
            background: transparent;
            color: #4a5568;
            border: 2px solid #e2e8f0;
            padding: 0.9rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }
        
        /* Footer */
        .footer {
            background: white;
            padding: 2.5rem 0;
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2rem;
        }
        
        .footer-section {
            flex: 1;
            min-width: 250px;
        }
        
        .footer-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            color: var(--text-dark);
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        
        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .footer-links a:hover {
            color: var(--accent-color);
        }
        
        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .error-title {
                font-size: 2.8rem;
            }
            
            .error-subtitle {
                font-size: 1.5rem;
            }
            
            .error-description {
                font-size: 1.1rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-primary-custom, .btn-outline-custom {
                width: 100%;
                justify-content: center;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 1.5rem;
            }
        }
        
        /* Efeitos de ilustração */
        .circle-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            z-index: -1;
        }
        
        .circle-1 {
            width: 300px;
            height: 300px;
            background: var(--accent-color);
            top: -150px;
            right: -150px;
        }
        
        .circle-2 {
            width: 200px;
            height: 200px;
            background: #4361ee;
            bottom: -100px;
            left: -100px;
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    <!-- Navbar -->
    

    <!-- Conteúdo Principal -->
    <main class="main-content">
        <div class="error-container">
            <div class="circle-shape circle-1"></div>
            <div class="circle-shape circle-2"></div>
            
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <h1 class="error-title">404</h1>
            <h2 class="error-subtitle">Página Não Encontrada</h2>
            
            <p class="error-description">
                Ops! Parece que você se perdeu no caminho. A página que você está procurando 
                não existe ou foi movida. Não se preocupe, vamos te ajudar a encontrar o 
                caminho de volta!
            </p>
            
            <div class="action-buttons">
                <a href="{{ route('home') }}" class="btn-primary-custom">
                    <i class="fas fa-home"></i>
                    Voltar para o Início
                </a>
                
                <a href="{{ route('produtos.index') }}" class="btn-outline-custom">
                    <i class="fas fa-box"></i>
                    Explorar Produtos
                </a>
                
                <a href="{{ route('sobre') }}" class="btn-outline-custom">
                    <i class="fas fa-info-circle"></i>
                    Sobre Nós
                </a>
            </div>
        </div>
    </main>

    @include('partials.footer')
    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>    
    <script>
        // Adicionando interatividade à página
        document.addEventListener('DOMContentLoaded', function() {
            // Animação de digitação para a descrição
            const descriptionText = "Ops! Parece que você se perdeu no caminho. A página que você está procurando não existe ou foi movida. Não se preocupe, vamos te ajudar a encontrar o caminho de volta!";
            const descriptionElement = document.querySelector('.error-description');
            
            // Simular efeito de digitação
            let i = 0;
            const speed = 30;
            
            function typeWriter() {
                if (i < descriptionText.length) {
                    descriptionElement.innerHTML += descriptionText.charAt(i);
                    i++;
                    setTimeout(typeWriter, speed);
                }
            }
            
            // Iniciar o efeito de digitação
            descriptionElement.innerHTML = '';
            setTimeout(typeWriter, 1000);
            
            // Adicionar efeito de flutuação para os botões
            const buttons = document.querySelectorAll('.btn-primary-custom, .btn-outline-custom');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', () => {
                    button.style.transform = 'translateY(-3px)';
                });
                
                button.addEventListener('mouseleave', () => {
                    button.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>