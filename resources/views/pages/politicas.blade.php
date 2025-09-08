<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Políticas - Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ESTILOS EXCLUSIVOS PARA A PÁGINA DE POLÍTICAS */
        .policy-page-body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf1 100%);
            color: #2d3142;
            line-height: 1.6;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        
        .policy-page-container {
            max-width: 1000px;
            width: 100%;
            padding: 20px 15px;
            margin: 0 auto;
            flex: 1;
        }
        
        .policy-page-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px 0;
        }
        
        .policy-page-title {
            font-weight: 800;
            color: #2d3142;
            margin: 0 0 15px 0;
            font-size: 2.5rem;
            position: relative;
            display: inline-block;
        }
        
        .policy-page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 4px;
            background: linear-gradient(to right, #4361ee, #3a0ca3);
            border-radius: 2px;
        }
        
        .policy-page-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .policy-content-box {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .policy-section {
            padding: 25px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .policy-section:last-child {
            border-bottom: none;
        }
        
        .policy-section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .policy-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        
        .policy-section-title {
            font-weight: 700;
            font-size: 1.4rem;
            color: #2d3142;
            margin: 0;
        }
        
        .policy-text-content {
            padding-left: 60px;
        }
        
        .policy-text {
            font-size: 1rem;
            line-height: 1.6;
            color: #2d3142;
            margin-bottom: 15px;
        }
        
        .policy-list {
            margin: 15px 0;
            padding-left: 20px;
        }
        
        .policy-list li {
            margin-bottom: 8px;
            line-height: 1.5;
        }
        
        .policy-highlight {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(58, 12, 163, 0.1));
            border-left: 3px solid #4361ee;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        
        .policy-contact-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            margin-top: 30px;
        }
        
        .policy-contact-title {
            color: #4361ee;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .policy-contact-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        
        .policy-contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #495057;
        }
        
        .policy-contact-item i {
            color: #4361ee;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .policy-page-container {
                padding: 15px;
            }
            
            .policy-page-title {
                font-size: 2rem;
            }
            
            .policy-section {
                padding: 20px;
            }
            
            .policy-section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .policy-text-content {
                padding-left: 0;
            }
            
            .policy-contact-info {
                flex-direction: column;
                gap: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .policy-page-title {
                font-size: 1.7rem;
            }
            
            .policy-page-subtitle {
                font-size: 1rem;
            }
            
            .policy-section-title {
                font-size: 1.2rem;
            }
            
            .policy-text {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body class="policy-page-body">
    <!-- Navbar -->
    @include('partials.navbar')

    <div class="policy-page-container">
        <!-- Cabeçalho -->
        <div class="policy-page-header">
            <h1 class="policy-page-title">Políticas do Site</h1>
            <p class="policy-page-subtitle">Conheça nossas políticas e termos de uso para uma experiência transparente e segura</p>
        </div>

        <!-- Conteúdo das políticas -->
        <div class="policy-content-box">
            <!-- Política de Privacidade -->
            <div class="policy-section">
                <div class="policy-section-header">
                    <div class="policy-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h2 class="policy-section-title">Política de Privacidade</h2>
                </div>
                <div class="policy-text-content">
                    <p class="policy-text">
                        Sua privacidade é importante para nós. Esta política explica como coletamos, usamos e protegemos suas informações pessoais quando você utiliza nossos serviços.
                    </p>
                    
                    <div class="policy-highlight">
                        <strong>Informações que coletamos:</strong> Dados de cadastro, informações de uso, cookies e dados de dispositivos.
                    </div>
                    
                    <h4>Como utilizamos suas informações</h4>
                    <ul class="policy-list">
                        <li>Para fornecer e melhorar nossos serviços</li>
                        <li>Para personalizar sua experiência</li>
                        <li>Para comunicação sobre produtos e serviços</li>
                        <li>Para fins de segurança e prevenção de fraudes</li>
                    </ul>
                    
                    <p class="policy-text">
                        Seus dados são protegidos com medidas de segurança avançadas e nunca são vendidos a terceiros. Você pode solicitar a exclusão de seus dados a qualquer momento.
                    </p>
                </div>
            </div>

            <!-- Termos de Uso -->
            <div class="policy-section">
                <div class="policy-section-header">
                    <div class="policy-icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h2 class="policy-section-title">Termos de Uso</h2>
                </div>
                <div class="policy-text-content">
                    <p class="policy-text">
                        Ao utilizar nosso site e nossos serviços, você concorda com estes termos de uso. Leia atentamente antes de prosseguir.
                    </p>
                    
                    <h4>Conduta do Usuário</h4>
                    <p class="policy-text">
                        Você concorda em não utilizar nossos serviços para:
                    </p>
                    <ul class="policy-list">
                        <li>Violar qualquer lei ou regulamento aplicável</li>
                        <li>Enviar conteúdo ilegal, difamatório ou ofensivo</li>
                        <li>Realizar atividades fraudulentas</li>
                        <li>Interferir na segurança ou funcionamento do site</li>
                    </ul>
                    
                    <h4>Propriedade Intelectual</h4>
                    <p class="policy-text">
                        Todo o conteúdo do site, incluindo textos, gráficos, logos e software, é propriedade nossa ou de nossos licenciadores e está protegido por leis de direitos autorais.
                    </p>
                </div>
            </div>

            <!-- Política de Trocas e Devoluções -->
            <div class="policy-section">
                <div class="policy-section-header">
                    <div class="policy-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h2 class="policy-section-title">Trocas e Devoluções</h2>
                </div>
                <div class="policy-text-content">
                    <p class="policy-text">
                        Garantimos sua satisfação com nossos produtos. Caso não fique satisfeito, oferecemos políticas flexíveis para trocas e devoluções.
                    </p>
                    
                    <h4>Prazo para Devolução</h4>
                    <p class="policy-text">
                        Você tem até 30 dias corridos a partir da data de recebimento para solicitar devolução ou troca de produtos.
                    </p>
                    
                    <h4>Condições para Devolução</h4>
                    <ul class="policy-list">
                        <li>Produto deve estar na embalagem original</li>
                        <li>Todos os acessórios devem ser incluídos</li>
                        <li>Produto não deve apresentar sinais de uso</li>
                        <li>Nota fiscal deve ser apresentada</li>
                    </ul>
                    
                    <div class="policy-highlight">
                        <strong>Reembolsos:</strong> Os valores serão reembolsados na mesma forma de pagamento em até 10 dias úteis após a aprovação da devolução.
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção de contato -->
        <div class="policy-contact-section">
            <h3 class="policy-contact-title">Dúvidas sobre nossas políticas?</h3>
            <p class="policy-text">Entre em contato conosco para esclarecer qualquer questão sobre nossas políticas ou termos de uso.</p>
            
            <div class="policy-contact-info">
                <div class="policy-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>contato@techstore.com</span>
                </div>
                <div class="policy-contact-item">
                    <i class="fas fa-phone"></i>
                    <span>(11) 3456-7890</span>
                </div>
                <div class="policy-contact-item">
                    <i class="fas fa-clock"></i>
                    <span>Seg-Sex: 9h-18h</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer - INCLUÍDO SEM ALTERAÇÕES -->
    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Adicionar a classe active ao link da navbar
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link-minimal');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath || 
                    (link.getAttribute('href') && currentPath.includes(link.getAttribute('href')))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>