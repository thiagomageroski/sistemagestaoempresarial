<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer TechStore</title>
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
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Footer Estilizado */
        .techstore-footer {
            background: linear-gradient(135deg, var(--dark-color) 0%, #1a1d28 100%);
            color: white;
            padding: 4rem 0 2rem;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .techstore-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                var(--primary-color) 20%, 
                var(--success-color) 50%, 
                var(--primary-color) 80%, 
                transparent 100%);
        }

        .footer-wave {
            position: absolute;
            top: -5px;
            left: 0;
            width: 100%;
            height: 15px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%234361ee'/%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%234361ee'/%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%234361ee'/%3E%3C/svg%3E");
            background-size: 1200px 100px;
            animation: wave 15s linear infinite;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            position: relative;
            z-index: 2;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand {
            margin-bottom: 1.5rem;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 800;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            text-decoration: none;
        }

        .footer-logo i {
            color: var(--primary-light);
            font-size: 2.2rem;
        }

        .footer-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 2rem;
            max-width: 320px;
            font-size: 1rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-link:hover {
            background: var(--primary-color);
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
        }

        .footer-section-title {
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .footer-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 2px;
            transition: var(--transition);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-link-item {
            margin-bottom: 0.85rem;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1rem;
            padding: 0.5rem 0;
        }

        .footer-link:hover {
            color: var(--primary-light);
            transform: translateX(8px);
        }

        .footer-link i {
            font-size: 0.9rem;
            color: var(--primary-color);
            transition: var(--transition);
            width: 16px;
        }

        .footer-link:hover i {
            color: var(--primary-light);
        }

        .footer-contact {
            list-style: none;
            padding: 0;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.5;
        }

        .contact-item i {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-top: 0.2rem;
            flex-shrink: 0;
        }

        .contact-info {
            flex: 1;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .copyright {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
        }

        .payment-methods {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .payment-icons {
            display: flex;
            gap: 0.5rem;
        }

        .payment-icon {
            width: 35px;
            height: 24px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.8);
            transition: var(--transition);
        }

        .payment-icon:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .security-badges {
            display: flex;
            gap: 0.75rem;
        }

        .badge {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge:hover {
            background: var(--success-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(6, 214, 160, 0.3);
        }

        /* Animações */
        @keyframes wave {
            0% {
                background-position-x: 0;
            }
            100% {
                background-position-x: 1200px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-content > * {
            animation: fadeInUp 0.6s ease;
        }

        /* Efeitos de hover para seções */
        .footer-section:hover .footer-section-title::after {
            width: 60px;
            background: var(--success-color);
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 2.5rem;
            }
            
            .footer-brand {
                grid-column: 1 / -1;
                text-align: center;
                margin-bottom: 0;
            }
            
            .footer-description {
                max-width: none;
                margin: 0 auto 2rem;
            }
            
            .footer-social {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .techstore-footer {
                padding: 3rem 0 2rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 2.5rem;
                text-align: center;
            }
            
            .footer-section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .footer-bottom {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }
            
            .payment-methods {
                justify-content: center;
            }
            
            .security-badges {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 576px) {
            .footer-container {
                padding: 0 1rem;
            }
            
            .footer-logo {
                font-size: 1.8rem;
            }
            
            .footer-logo i {
                font-size: 2rem;
            }
            
            .social-link {
                width: 40px;
                height: 40px;
            }
            
            .payment-methods {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .footer-bottom {
                text-align: center;
            }
        }

        /* Melhorias de acessibilidade */
        .footer-link:focus,
        .social-link:focus {
            outline: 2px solid var(--primary-light);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <!-- Conteúdo da página aqui -->

    <footer class="techstore-footer">
        <div class="footer-wave"></div>
        <div class="footer-container">
            <div class="footer-content">
                <!-- Brand Section -->
                <div class="footer-brand">
                    <a href="/" class="footer-logo">
                        <i class="fas fa-laptop"></i>
                        <span>TechStore</span>
                    </a>
                    <p class="footer-description">
                        Sua loja de tecnologia de confiança. Oferecemos os melhores produtos 
                        com preços imbatíveis e entrega rápida para todo o Brasil.
                    </p>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com/" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://x.com/" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.youtube.com/" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="footer-section">
                    <h3 class="footer-section-title">Produtos</h3>
                    <ul class="footer-links">
                        <li class="footer-link-item">
                            <a href="/produtos" class="footer-link">
                                <i class="fas fa-chevron-right"></i>
                                Todos os Produtos
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/sobre" class="footer-link">
                                <i class="fas fa-chevron-right"></i>
                                Sobre Nós
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/politicas" class="footer-link">
                                <i class="fas fa-chevron-right"></i>
                                Central de Ajuda
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/politicas" class="footer-link">
                                <i class="fas fa-chevron-right"></i>
                                Política de Garantia
                            </a>
                        </li>
                        <li class="footer-link-item">
                            <a href="/politicas" class="footer-link">
                                <i class="fas fa-chevron-right"></i>
                                Trocas e Devoluções
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Suporte Section -->
                

                <!-- Contact Section -->
                <div class="footer-section">
                    <h3 class="footer-section-title">Contato &amp; Localização</h3>
                    <ul class="footer-contact">
                        <li class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="contact-info">
                                <strong>Endereço</strong><br>
                                Av. Paulista, 1234<br>
                                São Paulo - SP, 01310-100
                            </div>
                        </li>
                        <li class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div class="contact-info">
                                <strong>Telefone</strong><br>
                                (11) 99999-9999
                            </div>
                        </li>
                        <li class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div class="contact-info">
                                <strong>Email</strong><br>
                                contato@techstore.com.br
                            </div>
                        </li>
                        <li class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div class="contact-info">
                                <strong>Horário</strong><br>
                                Seg-Sex: 9h-18h<br>
                                Sábado: 9h-13h
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; 2024 TechStore - Todos os direitos reservados. CNPJ: 12.345.678/0001-90
                </div>
                
                <div class="payment-methods">
                    <span>Pagamento seguro:</span>
                    <div class="payment-icons">
                        <span class="payment-icon">💳</span>
                        <span class="payment-icon">📱</span>
                        <span class="payment-icon">🏦</span>
                    </div>
                </div>

                <div class="security-badges">
                    <span class="badge">🔒 Site Seguro</span>
                    <span class="badge">🚀 Entregas Rápidas</span>
                    <span class="badge">⭐ 5.0 Avaliação</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Adicionar ano atual dinamicamente
            const yearElement = document.querySelector('.copyright');
            if (yearElement) {
                const currentYear = new Date().getFullYear();
                yearElement.innerHTML = yearElement.innerHTML.replace('2024', currentYear);
            }

            // Animações de entrada em sequência
            const footerSections = document.querySelectorAll('.footer-section');
            footerSections.forEach((section, index) => {
                section.style.animationDelay = `${0.2 + (index * 0.1)}s`;
            });

            // Interação com os links
            const footerLinks = document.querySelectorAll('.footer-link');
            footerLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(8px)';
                });
                
                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>