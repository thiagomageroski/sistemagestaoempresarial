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
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #7209b7;
            --light-color: #f5f7fa;
            --dark-color: #2d3142;
            --text-color: #4a4a4a;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
        }
        
        .policy-page-body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf1 100%);
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        
        .policy-page-container {
            max-width: 1200px;
            width: 100%;
            padding: 20px 15px;
            margin: 0 auto;
            flex: 1;
        }
        
        .policy-page-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 40px 0 20px;
            position: relative;
        }
        
        .policy-page-title {
            font-weight: 800;
            color: var(--dark-color);
            margin: 0 0 15px 0;
            font-size: 2.8rem;
            position: relative;
            display: inline-block;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .policy-page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }
        
        .policy-page-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            max-width: 700px;
            margin: 25px auto 0;
            line-height: 1.5;
        }
        
        /* Navegação lateral para políticas */
        .policy-navigation {
            position: sticky;
            top: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin-bottom: 30px;
            z-index: 100;
        }
        
        .policy-nav-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 15px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .policy-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .policy-nav-item {
            margin-bottom: 8px;
        }
        
        .policy-nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .policy-nav-link:hover, .policy-nav-link.active {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(58, 12, 163, 0.1));
            color: var(--primary-color);
            transform: translateX(5px);
        }
        
        .policy-nav-link i {
            width: 20px;
            text-align: center;
            font-size: 0.9rem;
        }
        
        /* Conteúdo principal */
        .policy-content-box {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        
        .policy-content-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .policy-section {
            padding: 30px;
            border-bottom: 1px solid #e9ecef;
            scroll-margin-top: 20px;
        }
        
        .policy-section:last-child {
            border-bottom: none;
        }
        
        .policy-section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            cursor: pointer;
        }
        
        .policy-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }
        
        .policy-section-header:hover .policy-icon {
            transform: scale(1.1);
        }
        
        .policy-section-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark-color);
            margin: 0;
        }
        
        .policy-text-content {
            padding-left: 65px;
        }
        
        .policy-text {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-color);
            margin-bottom: 15px;
        }
        
        .policy-list {
            margin: 15px 0;
            padding-left: 20px;
        }
        
        .policy-list li {
            margin-bottom: 10px;
            line-height: 1.5;
            position: relative;
            padding-left: 10px;
        }
        
        .policy-list li::before {
            content: "•";
            color: var(--primary-color);
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        
        .policy-highlight {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(58, 12, 163, 0.1));
            border-left: 4px solid var(--primary-color);
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            position: relative;
        }
        
        .policy-highlight::before {
            content: "💡";
            position: absolute;
            top: -10px;
            left: -10px;
            background: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .policy-contact-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin-top: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .policy-contact-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        }
        
        .policy-contact-title {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .policy-contact-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 25px;
        }
        
        .policy-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-color);
            padding: 10px 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .policy-contact-item:hover {
            transform: translateY(-3px);
        }
        
        .policy-contact-item i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        /* Botão de voltar ao topo */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }
        
        /* Badge de atualização */
        .update-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--warning-color);
            color: white;
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        /* Accordion para seções */
        .policy-accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
        }
        
        .policy-accordion-content.open {
            max-height: 2000px;
        }
        
        .policy-section-header .toggle-icon {
            margin-left: auto;
            transition: transform 0.3s ease;
        }
        
        .policy-section-header.active .toggle-icon {
            transform: rotate(180deg);
        }
        
        /* Responsividade */
        @media (max-width: 992px) {
            .policy-navigation {
                position: static;
                margin-bottom: 20px;
            }
        }
        
        @media (max-width: 768px) {
            .policy-page-container {
                padding: 15px;
            }
            
            .policy-page-title {
                font-size: 2.2rem;
            }
            
            .policy-page-subtitle {
                font-size: 1.1rem;
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
            
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
            }
        }
        
        @media (max-width: 576px) {
            .policy-page-title {
                font-size: 1.9rem;
            }
            
            .policy-page-subtitle {
                font-size: 1rem;
            }
            
            .policy-section-title {
                font-size: 1.3rem;
            }
            
            .policy-text {
                font-size: 0.95rem;
            }
            
            .policy-contact-section {
                padding: 20px;
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
            <h1 class="policy-page-title">Políticas do Sistema</h1>
            <p class="policy-page-subtitle">Conheça nossas políticas e termos de uso para uma experiência transparente, segura e eficiente.</p>
        </div>

        <div class="row">
            <!-- Navegação lateral -->
            <div class="col-lg-3">
                <div class="policy-navigation">
                    <div class="policy-nav-title">
                        <i class="fas fa-file-alt"></i>
                        <span>Índice de Políticas</span>
                    </div>
                    <ul class="policy-nav-list">
                        <li class="policy-nav-item"><a href="#privacidade" class="policy-nav-link active"><i class="fas fa-user-shield"></i> Privacidade</a></li>
                        <li class="policy-nav-item"><a href="#termos" class="policy-nav-link"><i class="fas fa-file-contract"></i> Termos de Uso</a></li>
                        <li class="policy-nav-item"><a href="#trocas" class="policy-nav-link"><i class="fas fa-exchange-alt"></i> Trocas e Devoluções</a></li>
                        <li class="policy-nav-item"><a href="#cookies" class="policy-nav-link"><i class="fas fa-cookie-bite"></i> Política de Cookies</a></li>
                        <li class="policy-nav-item"><a href="#seguranca" class="policy-nav-link"><i class="fas fa-shield-alt"></i> Segurança de Dados</a></li>
                        <li class="policy-nav-item"><a href="#lgpd" class="policy-nav-link"><i class="fas fa-gavel"></i> Conformidade LGPD</a></li>
                    </ul>
                </div>
            </div>

            <!-- Conteúdo das políticas -->
            <div class="col-lg-9">
                <!-- Política de Privacidade -->
                <div class="policy-content-box" id="privacidade">
                    <div class="policy-section">
                        <div class="policy-section-header">
                            <div class="policy-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h2 class="policy-section-title">Política de Privacidade</h2>
                            
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="policy-accordion-content open">
                            <div class="policy-text-content">
                                <p class="policy-text">
                                    Sua privacidade é de extrema importância para nós. Esta política detalha como coletamos, usamos, armazenamos e protegemos suas informações pessoais quando você utiliza nossos serviços, em conformidade com a Lei Geral de Proteção de Dados (LGPD).
                                </p>
                                
                                <div class="policy-highlight">
                                    <strong>Informações que coletamos:</strong> Dados de cadastro (nome, e-mail, telefone), informações de uso do sistema, cookies, dados de dispositivos, histórico de transações e preferências de usuário.
                                </div>
                                
                                <h4>Finalidades do Tratamento de Dados</h4>
                                <ul class="policy-list">
                                    <li>Fornecer, operar e melhorar nossos serviços</li>
                                    <li>Personalizar sua experiência e conteúdo</li>
                                    <li>Comunicação sobre produtos, serviços e atualizações</li>
                                    <li>Segurança, prevenção de fraudes e conformidade legal</li>
                                    <li>Análise de dados para melhorias no sistema</li>
                                    <li>Suporte ao cliente e resolução de problemas</li>
                                </ul>
                                
                                <h4>Compartilhamento de Dados</h4>
                                <p class="policy-text">
                                    Seus dados são tratados com confidencialidade e compartilhados apenas quando necessário para:
                                </p>
                                <ul class="policy-list">
                                    <li>Prestadores de serviços essenciais ao funcionamento do sistema</li>
                                    <li>Cumprimento de obrigações legais ou requisições judiciais</li>
                                    <li>Proteção de direitos, propriedade ou segurança nossa e de nossos usuários</li>
                                </ul>
                                
                                <p class="policy-text">
                                    Seus dados são protegidos com medidas de segurança avançadas, incluindo criptografia, controle de acesso e monitoramento contínuo. Você pode solicitar a exclusão de seus dados a qualquer momento através do nosso canal de privacidade.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Termos de Uso -->
                <div class="policy-content-box" id="termos">
                    <div class="policy-section">
                        <div class="policy-section-header">
                            <div class="policy-icon">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <h2 class="policy-section-title">Termos de Uso</h2>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="policy-accordion-content">
                            <div class="policy-text-content">
                                <p class="policy-text">
                                    Ao utilizar nosso site e nossos serviços, você concorda integralmente com estes termos de uso. Recomendamos a leitura atenta antes de prosseguir com a utilização do sistema.
                                </p>
                                
                                <h4>Conduta do Usuário</h4>
                                <p class="policy-text">
                                    Você concorda em não utilizar nossos serviços para:
                                </p>
                                <ul class="policy-list">
                                    <li>Violar qualquer lei, regulamento aplicável ou direitos de terceiros</li>
                                    <li>Enviar conteúdo ilegal, difamatório, ofensivo ou inadequado</li>
                                    <li>Realizar atividades fraudulentas, phishing ou enganosas</li>
                                    <li>Interferir na segurança, funcionamento ou performance do sistema</li>
                                    <li>Tentar acessar áreas restritas sem autorização</li>
                                    <li>Distribuir malware, vírus ou qualquer código malicioso</li>
                                </ul>
                                
                                <h4>Propriedade Intelectual</h4>
                                <p class="policy-text">
                                    Todo o conteúdo do sistema, incluindo textos, gráficos, logos, interfaces, software e código-fonte, é propriedade nossa ou de nossos licenciadores e está protegido por leis de direitos autorais, marcas registradas e outras leis de propriedade intelectual.
                                </p>
                                
                                <h4>Limitação de Responsabilidade</h4>
                                <p class="policy-text">
                                    Nosso sistema é fornecido "no estado em que se encontra". Não garantimos que o serviço será ininterrupto, seguro ou livre de erros. Em nenhuma circunstância seremos responsáveis por danos indiretos, incidentais ou consequenciais resultantes do uso ou incapacidade de uso do sistema.
                                </p>
                                
                                <div class="policy-highlight">
                                    <strong>Modificações dos Termos:</strong> Reservamo-nos o direito de modificar estes termos a qualquer momento. Alterações significativas serão comunicadas com antecedência razóavel.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Política de Trocas e Devoluções -->
                <div class="policy-content-box" id="trocas">
                    <div class="policy-section">
                        <div class="policy-section-header">
                            <div class="policy-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <h2 class="policy-section-title">Trocas e Devoluções</h2>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="policy-accordion-content">
                            <div class="policy-text-content">
                                <p class="policy-text">
                                    Garantimos sua total satisfação com nossos produtos e serviços. Caso não fique satisfeito, oferecemos políticas claras e flexíveis para trocas e devoluções, de acordo com o Código de Defesa do Consumidor.
                                </p>
                                
                                <h4>Prazo para Devolução</h4>
                                <p class="policy-text">
                                    Você tem até <strong>30 dias corridos</strong> a partir da data de recebimento para solicitar devolução ou troca de produtos, para itens em perfeito estado.
                                </p>
                                
                                <h4>Condições para Devolução</h4>
                                <ul class="policy-list">
                                    <li>Produto deve estar na embalagem original, intacta e com todos os selos</li>
                                    <li>Todos os acessórios, manuais e certificados devem ser incluídos</li>
                                    <li>Produto não deve apresentar sinais de uso, avarias ou violações</li>
                                    <li>Nota fiscal deve ser apresentada (original ou cópia)</li>
                                    <li>Etiquetas e identificações do produto devem estar preservadas</li>
                                </ul>
                                
                                <h4>Processo de Devolução</h4>
                                <ol class="policy-list">
                                    <li>Entre em contato com nosso suporte dentro do prazo estabelecido</li>
                                    <li>Informe o motivo da devolução/troca e número do pedido</li>
                                    <li>Nossa equipe enviará instruções para postagem do produto</li>
                                    <li>Após recebimento e análise, processaremos sua solicitação</li>
                                </ol>
                                
                                <div class="policy-highlight">
                                    <strong>Reembolsos:</strong> Os valores serão reembolsados na mesma forma de pagamento em até 10 dias úteis após a aprovação da devolução. Para pagamentos com cartão de crédito, o estorno aparecerá na fatura seguinte.
                                </div>
                                
                                <h4>Casos de Arrependimento</h4>
                                <p class="policy-text">
                                    Para compras realizadas online, você tem direito ao arrependimento em até 7 dias corridos a partir do recebimento do produto, conforme Artigo 49 do Código de Defesa do Consumidor.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Política de Cookies -->
                <div class="policy-content-box" id="cookies">
                    <div class="policy-section">
                        <div class="policy-section-header">
                            <div class="policy-icon">
                                <i class="fas fa-cookie-bite"></i>
                            </div>
                            <h2 class="policy-section-title">Política de Cookies</h2>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="policy-accordion-content">
                            <div class="policy-text-content">
                                <p class="policy-text">
                                    Utilizamos cookies e tecnologias similares para melhorar sua experiência, personalizar conteúdo e anúncios, fornecer recursos de mídia social e analisar nosso tráfego.
                                </p>
                                
                                <h4>O que são Cookies?</h4>
                                <p class="policy-text">
                                    Cookies são pequenos arquivos de texto armazenados no seu dispositivo quando você visita nosso site. Eles nos ajudam a lembrar de suas preferências, entender como você interage conosco e melhorar continuamente nossos serviços.
                                </p>
                                
                                <h4>Tipos de Cookies que Utilizamos</h4>
                                <ul class="policy-list">
                                    <li><strong>Cookies Essenciais:</strong> Necessários para o funcionamento básico do site</li>
                                    <li><strong>Cookies de Desempenho:</strong> Coletam informações sobre como os visitantes usam o site</li>
                                    <li><strong>Cookies de Funcionalidade:</strong> Lembram escolhas que você fez para personalizar sua experiência</li>
                                    <li><strong>Cookies de Publicidade:</strong> Usados para entregar anúncios mais relevantes para você</li>
                                </ul>
                                
                                <h4>Controle de Cookies</h4>
                                <p class="policy-text">
                                    Você pode controlar e/ou excluir cookies como desejar. Você pode excluir todos os cookies já existentes em seu dispositivo e configurar a maioria dos navegadores para impedir que sejam colocados. No entanto, se fizer isso, pode ter que ajustar manualmente algumas preferências cada vez que visitar nosso site e alguns serviços e funcionalidades podem não funcionar.
                                </p>
                                
                                <div class="policy-highlight">
                                    <strong>Consentimento:</strong> Ao continuar a usar nosso site, você concorda com o uso de cookies de acordo com esta política.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Segurança de Dados -->
                <div class="policy-content-box" id="seguranca">
                    <div class="policy-section">
                        <div class="policy-section-header">
                            <div class="policy-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h2 class="policy-section-title">Segurança de Dados</h2>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="policy-accordion-content">
                            <div class="policy-text-content">
                                <p class="policy-text">
                                    Implementamos medidas técnicas e organizacionais robustas para proteger seus dados contra acesso não autorizado, alteração, divulgação ou destruição.
                                </p>
                                
                                <h4>Medidas de Segurança Implementadas</h4>
                                <ul class="policy-list">
                                    <li><strong>Criptografia:</strong> Dados sensíveis são criptografados em trânsito (SSL/TLS) e em repouso</li>
                                    <li><strong>Controle de Acesso:</strong> Política de privilégio mínimo e autenticação multifator</li>
                                    <li><strong>Monitoramento Contínuo:</strong> Sistemas de detecção e prevenção de intrusões</li>
                                    <li><strong>Backups Regulares:</strong> Cópias de segurança realizadas periodicamente</li>
                                    <li><strong>Atualizações de Segurança:</strong> Aplicação regular de patches e correções</li>
                                    <li><strong>Testes de Penetração:</strong> Avaliações periódicas de vulnerabilidades</li>
                                </ul>
                                
                                <h4>Procedimentos em Caso de Violação</h4>
                                <p class="policy-text">
                                    Em caso de violação de dados que possa representar risco aos direitos e liberdades dos usuários, notificaremos as autoridades competentes e os afetados no prazo máximo estabelecido pela LGPD, detalhando a natureza da violação, dados envolvidos e medidas adotadas.
                                </p>
                                
                                <div class="policy-highlight">
                                    <strong>Compromisso com a Segurança:</strong> Investimos continuamente em tecnologias e práticas de segurança para manter a confidencialidade, integridade e disponibilidade de seus dados.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conformidade LGPD -->
                <div class="policy-content-box" id="lgpd">
                    <div class="policy-section">
                        <div class="policy-section-header">
                            <div class="policy-icon">
                                <i class="fas fa-gavel"></i>
                            </div>
                            <h2 class="policy-section-title">Conformidade com a LGPD</h2>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="policy-accordion-content">
                            <div class="policy-text-content">
                                <p class="policy-text">
                                    Estamos em conformidade com a Lei Geral de Proteção de Dados (Lei nº 13.709/2018), assegurando os direitos dos titulares de dados e adotando as melhores práticas para tratamento de informações pessoais.
                                </p>
                                
                                <h4>Direitos dos Titulares</h4>
                                <p class="policy-text">
                                    De acordo com a LGPD, você tem direito a:
                                </p>
                                <ul class="policy-list">
                                    <li>Confirmação da existência de tratamento dos seus dados</li>
                                    <li>Acesso aos seus dados pessoais</li>
                                    <li>Correção de dados incompletos, inexatos ou desatualizados</li>
                                    <li>Anonimização, bloqueio ou eliminação de dados desnecessários</li>
                                    <li>Portabilidade dos dados a outro fornecedor de serviço</li>
                                    <li>Eliminação dos dados tratados com consentimento</li>
                                    <li>Informação sobre entidades com quem compartilhamos seus dados</li>
                                    <li>Revogação do consentimento</li>
                                </ul>
                                
                                <h4>Como Exercer Seus Direitos</h4>
                                <p class="policy-text">
                                    Para exercer qualquer um dos direitos acima, entre em contato conosco através dos canais indicados nesta página. Responderemos sua solicitação no prazo máximo de 15 dias, conforme estabelecido pela lei.
                                </p>
                                
                                <h4>Encarregado de Proteção de Dados (DPO)</h4>
                                <p class="policy-text">
                                    Nomeamos um Encarregado de Proteção de Dados (DPO) para supervisionar nosso programa de conformidade com a LGPD. Você pode entrar em contato com nosso DPO através do e-mail: <strong>dpo@techstore.com</strong>.
                                </p>
                                
                                <div class="policy-highlight">
                                    <strong>Transparência:</strong> Estamos comprometidos com a transparência no tratamento de dados e mantemos registro das operações de tratamento, conforme exigido pela LGPD.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção de contato -->
        <div class="policy-contact-section">
            <h3 class="policy-contact-title">Dúvidas sobre nossas políticas?</h3>
            <p class="policy-text">Entre em contato conosco para esclarecer qualquer questão sobre nossas políticas, termos de uso ou para exercer seus direitos de titular de dados.</p>
            
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
                <div class="policy-contact-item">
                    <i class="fas fa-user-shield"></i>
                    <span>DPO: dpo@techstore.com</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Botão de voltar ao topo -->
    <div class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </div>

    <!-- Footer - INCLUÍDO SEM ALTERAÇÕES -->
    @include('partials.footer')

    <script src="//code.jivosite.com/widget/1Qbb3wfMiV" async></script>
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
            
            // Navegação suave para âncoras
            document.querySelectorAll('.policy-nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        // Atualizar navegação ativa
                        document.querySelectorAll('.policy-nav-link').forEach(item => {
                            item.classList.remove('active');
                        });
                        this.classList.add('active');
                        
                        // Scroll suave para a seção
                        window.scrollTo({
                            top: targetElement.offsetTop - 20,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Botão de voltar ao topo
            const backToTopButton = document.getElementById('backToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.add('show');
                } else {
                    backToTopButton.classList.remove('show');
                }
            });
            
            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            // Accordion para seções de política
            const policyHeaders = document.querySelectorAll('.policy-section-header');
            
            policyHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const isOpen = content.classList.contains('open');
                    
                    // Fechar todos os accordions
                    document.querySelectorAll('.policy-accordion-content').forEach(item => {
                        item.classList.remove('open');
                    });
                    
                    document.querySelectorAll('.policy-section-header').forEach(item => {
                        item.classList.remove('active');
                    });
                    
                    // Abrir o clicado se não estava aberto
                    if (!isOpen) {
                        content.classList.add('open');
                        this.classList.add('active');
                    }
                });
            });
            
            // Ativar a primeira seção por padrão
            if (policyHeaders.length > 0) {
                policyHeaders[0].classList.add('active');
                document.querySelectorAll('.policy-accordion-content')[0].classList.add('open');
            }
            
            // Atualizar navegação com base no scroll
            window.addEventListener('scroll', function() {
                const sections = document.querySelectorAll('.policy-content-box');
                const navLinks = document.querySelectorAll('.policy-nav-link');
                
                let currentSection = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - 100;
                    const sectionHeight = section.clientHeight;
                    
                    if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionTop + sectionHeight) {
                        currentSection = section.getAttribute('id');
                    }
                });
                
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + currentSection) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>
</html>