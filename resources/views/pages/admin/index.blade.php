<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #7209b7;
            --light-bg: #f8f9fa;
            --dark-text: #2d3142;
            --light-text: #6c757d;
            --border-radius: 12px;
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaf1 100%);
            color: var(--dark-text);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .page-title {
            font-weight: 700;
            color: var(--dark-text);
            margin: 0;
            position: relative;
            padding-left: 1.5rem;
        }

        .page-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 80%;
            width: 5px;
            background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
            border-radius: 10px;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        }

        .section-title {
            font-weight: 600;
            color: var(--dark-text);
            margin: 2.5rem 0 1.2rem 0;
            padding-left: 0.75rem;
            border-left: 4px solid var(--primary-color);
        }

        .clientes-list {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .cliente-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
        }

        .cliente-item:last-child {
            border-bottom: none;
        }

        .cliente-item:hover {
            background-color: #f8f9ff;
            transform: translateX(5px);
        }

        .cliente-nome {
            font-weight: 500;
            color: var(--dark-text);
            margin: 0;
        }

        .cliente-email {
            font-size: 0.9rem;
            color: var(--light-text);
            margin: 0;
        }

        .cliente-item:hover .cliente-nome {
            color: var(--primary-color);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--light-text);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .empty-state a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .empty-state a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: var(--transition);
        }

        .empty-state a:hover {
            color: var(--secondary-color);
        }

        .empty-state a:hover::after {
            width: 100%;
        }

        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-in {
            animation: fadeIn 0.5s ease forwards;
        }

        .cliente-item {
            opacity: 0;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .cliente-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
        }

        /* Efeito de loading para quando os dados estiverem sendo carregados */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
            height: 1rem;
            margin-bottom: 0.5rem;
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
    <div class="admin-container">
        <div class="page-header">
            <h1 class="page-title">Admin</h1>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-chart-line me-2"></i>Ir para o Dashboard
            </a>
        </div>

        <h2 class="section-title">Clientes</h2>
        <div class="clientes-list">
            <a href="#" class="cliente-item animate-in" style="animation-delay: 0.1s">
                <span class="cliente-nome">Maria Silva</span>
                <small class="cliente-email">maria.silva@email.com</small>
            </a>
            <a href="#" class="cliente-item animate-in" style="animation-delay: 0.2s">
                <span class="cliente-nome">João Santos</span>
                <small class="cliente-email">joao.santos@email.com</small>
            </a>
            <a href="#" class="cliente-item animate-in" style="animation-delay: 0.3s">
                <span class="cliente-nome">Ana Oliveira</span>
                <small class="cliente-email">ana.oliveira@email.com</small>
            </a>
            <a href="#" class="cliente-item animate-in" style="animation-delay: 0.4s">
                <span class="cliente-nome">Pedro Costa</span>
                <small class="cliente-email">pedro.costa@email.com</small>
            </a>
            <a href="#" class="cliente-item animate-in" style="animation-delay: 0.5s">
                <span class="cliente-nome">Carla Mendes</span>
                <small class="cliente-email">carla.mendes@email.com</small>
            </a>
        </div>

        <!-- Estado vazio (seria exibido condicionalmente) -->
        <!--
        <div class="empty-state">
            <i class="fas fa-folder-open"></i>
            <p class="text-muted">Selecione um módulo no menu. Ex.: <a href="#">Clientes</a></p>
        </div>
        -->
    </div>

    <script>
        // Adicionando animação de entrada para os itens
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.cliente-item');
            items.forEach((item, index) => {
                item.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            });
        });
    </script>
</body>
</html>