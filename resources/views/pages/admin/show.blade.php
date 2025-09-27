<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhe do Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary-color: #6c757d;
            --success-color: #06d6a0;
            --success-light: rgba(6, 214, 160, 0.1);
            --dark-color: #2d3142;
            --light-color: #f8f9fa;
            --gray-light: #e9ecef;
            --text-muted: #6c757d;
            --border-radius: 16px;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            color: var(--dark-color);
            line-height: 1.6;
            padding: 2rem 0;
        }

        .container-custom {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            animation: fadeIn 0.6s ease;
        }

        .page-title {
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
            position: relative;
            padding-left: 1.5rem;
            font-size: 1.8rem;
        }

        .page-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 80%;
            width: 5px;
            background: linear-gradient(to bottom, var(--primary-color), var(--primary-dark));
            border-radius: 10px;
        }

        .btn-secondary {
            background: linear-gradient(to right, var(--secondary-color), #5a6268);
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.25rem;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(108, 117, 125, 0.25);
            background: linear-gradient(to right, #5a6268, #495057);
        }

        .detail-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: var(--transition);
            animation: slideUp 0.7s ease;
        }

        .detail-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .card-body {
            padding: 2rem;
        }

        .description {
            font-size: 1.1rem;
            line-height: 1.7;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            background: var(--light-color);
            border-radius: 12px;
            border-left: 4px solid var(--primary-color);
        }

        .meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            padding: 1.25rem;
            background: var(--light-color);
            border-radius: 12px;
            margin-bottom: 0;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .meta-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .meta-text {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .meta-value {
            font-weight: 600;
            color: var(--dark-color);
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .bg-success {
            background: linear-gradient(135deg, var(--success-color), #05b387) !important;
        }

        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Decoração adicional */
        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.03;
            font-size: 10rem;
            color: var(--primary-color);
        }

        .decoration-1 {
            top: 10%;
            right: 10%;
        }

        .decoration-2 {
            bottom: 10%;
            left: 10%;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .page-title {
                font-size: 1.5rem;
                padding-left: 1rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .meta-info {
                flex-direction: column;
                gap: 1rem;
            }
            
            .description {
                padding: 1.25rem;
                font-size: 1rem;
            }
            
            .decoration {
                display: none;
            }
        }

        /* Efeitos de foco para acessibilidade */
        .btn-secondary:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Estados de loading (para possível implementação futura) */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>
<body>
    <i class="fas fa-file-alt decoration decoration-1"></i>
    <i class="fas fa-info-circle decoration decoration-2"></i>

    <div class="container-custom">
        <div class="page-header">
            <h1 class="page-title">Título do Registro Detalhado</h1>
            <button class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </button>
        </div>

        <div class="detail-card">
            <div class="card-body">
                <p class="description">
                    Esta é uma descrição detalhada do registro. Ela contém informações importantes sobre o item que está sendo visualizado. Pode incluir detalhes, observações e qualquer informação relevante para o contexto deste registro.
                </p>
                
                <div class="meta-info">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="meta-text">
                            <span class="meta-label">Criado em</span>
                            <span class="meta-value">10/05/2023 14:30</span>
                        </div>
                    </div>
                    
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="meta-text">
                            <span class="meta-label">Status</span>
                            <span class="meta-value"><span class="badge bg-success">Ativo</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Adicionando interatividade
        document.addEventListener('DOMContentLoaded', function() {
            // Simular clique no botão voltar
            document.querySelector('.btn-secondary').addEventListener('click', function() {
                console.log('Navegar para a página anterior');
                // window.history.back(); // Descomente em implementação real
            });
            
            // Adicionar efeito de hover persistente ao card após interação
            const card = document.querySelector('.detail-card');
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.08)';
            });
        });
    </script>
</body>
</html>