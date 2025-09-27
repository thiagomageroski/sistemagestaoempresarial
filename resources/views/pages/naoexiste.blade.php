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
            --secondary-gradient: linear-gradient(135deg, #7209b7 0%, #3a0ca3 100%);
            --accent-color: #4cc9f0;
            --accent-light: #b6e3f7;
            --text-dark: #2d3748;
            --text-light: #718096;
            --light-bg: #f8fafc;
            --card-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            --hover-shadow: 0 35px 60px -12px rgba(58, 12, 163, 0.25);
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
            overflow-x: hidden;
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
            position: relative;
        }
        
        .error-container {
            max-width: 900px;
            text-align: center;
            padding: 4rem 3rem;
            background: white;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            margin: 2rem auto;
            position: relative;
            z-index: 10;
            overflow: hidden;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }
        
        .error-container:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }
        
        .error-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-gradient);
        }
        
        .error-icon {
            font-size: 8rem;
            margin-bottom: 1.5rem;
            color: var(--accent-color);
            position: relative;
            display: inline-block;
            animation: float 3s ease-in-out infinite;
            text-shadow: 0 10px 20px rgba(76, 201, 240, 0.3);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .error-title {
            font-size: 8rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: var(--secondary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            text-shadow: 0 5px 15px rgba(58, 12, 163, 0.2);
        }
        
        .error-subtitle {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .error-description {
            font-size: 1.3rem;
            color: var(--text-light);
            margin-bottom: 2.5rem;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
            font-weight: 500;
        }
        
        .action-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2.5rem;
        }
        
        .btn-primary-custom {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1.1rem 2.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.4s ease;
            box-shadow: 0 8px 25px rgba(58, 12, 163, 0.25);
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary-custom:hover::before {
            left: 100%;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(58, 12, 163, 0.35);
            color: white;
        }
        
        .btn-outline-custom {
            background: transparent;
            color: #4a5568;
            border: 2px solid #e2e8f0;
            padding: 1.1rem 2.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.4s ease;
            font-size: 1.1rem;
        }
        
        .btn-outline-custom:hover {
            border-color: var(--accent-color);
            background-color: rgba(76, 201, 240, 0.05);
            color: var(--accent-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
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
        
        /* Elementos decorativos */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
        }
        
        .floating-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            z-index: -1;
            animation: float-element 20s infinite linear;
        }
        
        @keyframes float-element {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }
        
        .element-1 {
            width: 300px;
            height: 300px;
            background: var(--accent-color);
            top: 5%;
            right: 5%;
            animation-duration: 25s;
        }
        
        .element-2 {
            width: 200px;
            height: 200px;
            background: #4361ee;
            bottom: 10%;
            left: 5%;
            animation-duration: 20s;
        }
        
        .element-3 {
            width: 150px;
            height: 150px;
            background: #7209b7;
            top: 20%;
            left: 10%;
            animation-duration: 30s;
        }
        
        .element-4 {
            width: 100px;
            height: 100px;
            background: #3a0ca3;
            bottom: 20%;
            right: 15%;
            animation-duration: 15s;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .error-title {
                font-size: 5rem;
            }
            
            .error-subtitle {
                font-size: 1.8rem;
            }
            
            .error-description {
                font-size: 1.1rem;
            }
            
            .error-icon {
                font-size: 6rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-primary-custom, .btn-outline-custom {
                width: 100%;
                justify-content: center;
                padding: 1rem 2rem;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .error-container {
                padding: 3rem 1.5rem;
            }
        }
        
        /* Efeito de partículas */
        .particles-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            background: var(--accent-light);
            border-radius: 50%;
            opacity: 0.3;
            animation: particle-float 15s infinite linear;
        }
        
        @keyframes particle-float {
            0% { transform: translateY(100vh) rotate(0deg); }
            100% { transform: translateY(-100px) rotate(360deg); }
        }
        
        /* Search box estilizada */
        .search-suggestion {
            margin-top: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .search-box {
            display: flex;
            margin-top: 1rem;
        }
        
        .search-input {
            flex: 1;
            padding: 0.8rem 1.2rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px 0 0 10px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--accent-color);
        }
        
        .search-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0 1.5rem;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .search-button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    @include('partials.navbar')
    
    <!-- Conteúdo Principal -->
    <main class="main-content">
        <!-- Elementos decorativos flutuantes -->
        <div class="floating-elements">
            <div class="floating-element element-1"></div>
            <div class="floating-element element-2"></div>
            <div class="floating-element element-3"></div>
            <div class="floating-element element-4"></div>
        </div>
        
        <!-- Partículas de fundo -->
        <div class="particles-container" id="particles"></div>
        
        <div class="error-container">
            <div class="error-icon">
                <i class="fas fa-map-signs"></i>
            </div>
            
            <h1 class="error-title">404</h1>
            <h2 class="error-subtitle">Página Não Encontrada</h2>
            
            <p class="error-description">
                Ops! Parece que você se perdeu no caminho digital. A página que você está procurando 
                não existe ou foi movida. Não se preocupe, vamos te ajudar a encontrar o 
                caminho de volta!
            </p>
            
            <div class="search-suggestion">
                <p>Ou tente pesquisar o que você está procurando:</p>
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Digite sua busca...">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('home') }}" class="btn-primary-custom">
                    <i class="fas fa-home"></i>
                    Voltar para o Início
                </a>
                
                <a href="{{ route('produtos.index') }}" class="btn-outline-custom">
                    <i class="fas fa-laptop"></i>
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
            // Criar partículas animadas
            createParticles();
            
            // Animação de digitação para a descrição
            const descriptionText = "Ops! Parece que você se perdeu no caminho digital. A página que você está procurando não existe ou foi movida. Não se preocupe, vamos te ajudar a encontrar o caminho de volta!";
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
                    button.style.transform = 'translateY(-5px)';
                });
                
                button.addEventListener('mouseleave', () => {
                    button.style.transform = 'translateY(0)';
                });
            });
            
            // Funcionalidade de busca
            const searchButton = document.querySelector('.search-button');
            const searchInput = document.querySelector('.search-input');
            
            searchButton.addEventListener('click', function() {
                if (searchInput.value.trim() !== '') {
                    alert(`Redirecionando para busca: "${searchInput.value}"`);
                    // Aqui você pode implementar a lógica de busca real
                    // window.location.href = `/busca?q=${encodeURIComponent(searchInput.value)}`;
                }
            });
            
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchButton.click();
                }
            });
        });
        
        // Função para criar partículas animadas
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = 15;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Tamanho aleatório
                const size = Math.random() * 10 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Posição inicial aleatória
                particle.style.left = `${Math.random() * 100}%`;
                
                // Atraso e duração de animação aleatórios
                const delay = Math.random() * 5;
                const duration = Math.random() * 10 + 10;
                particle.style.animationDelay = `${delay}s`;
                particle.style.animationDuration = `${duration}s`;
                
                container.appendChild(particle);
            }
        }
    </script>
</body>
</html>