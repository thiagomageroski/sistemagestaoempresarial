<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --success-color: #06d6a0;
            --warning-color: #ffd166;
            --danger-color: #ef476f;
            --info-color: #118ab2;
            --dark-color: #2d3142;
            --light-color: #f8f9fa;
            --border-radius: 16px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            color: #4a4e69;
            padding-bottom: 2rem;
        }

        .dashboard-header {
            background: linear-gradient(120deg, var(--primary-color), #3a0ca3);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .dashboard-header h1 {
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .metric-card {
            position: relative;
            padding: 1.5rem;
            color: white;
            height: 100%;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
        }

        .metric-card .icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 2.5rem;
            opacity: 0.2;
        }

        .metric-card .fw-bold {
            font-size: 1rem;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .metric-card .display-6 {
            font-weight: 700;
            margin-bottom: 0;
        }

        .text-bg-success {
            background: linear-gradient(45deg, var(--success-color), #04a57a);
        }

        .text-bg-primary {
            background: linear-gradient(45deg, var(--primary-color), #3a0ca3);
        }

        .text-bg-warning {
            background: linear-gradient(45deg, var(--warning-color), #ffb74d);
            color: #4a4e69 !important;
        }

        .text-bg-warning .icon {
            color: #4a4e69 !important;
        }

        .text-bg-danger {
            background: linear-gradient(45deg, var(--danger-color), #e91e63);
        }

        .table-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-top: 2rem;
        }

        .table-header {
            background: linear-gradient(120deg, var(--dark-color), #4a4e69);
            color: white;
            padding: 1.2rem 1.5rem;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .table-responsive {
            border-radius: 0 0 var(--border-radius) var(--border-radius);
        }

        table {
            margin-bottom: 0;
        }

        thead tr {
            background-color: #f8f9fa;
        }

        th {
            font-weight: 600;
            padding: 1rem !important;
            border-top: none;
            color: var(--dark-color);
        }

        td {
            padding: 1rem !important;
            vertical-align: middle;
            border-top: 1px solid #f1f3f7;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .table > :not(caption) > * > * {
            border-bottom-width: 0;
        }

        @media (max-width: 768px) {
            .metric-card {
                padding: 1rem;
            }
            
            .metric-card .icon {
                font-size: 2rem;
                top: 1rem;
                right: 1rem;
            }
            
            .metric-card .display-6 {
                font-size: 1.8rem;
            }
            
            .dashboard-header h1 {
                font-size: 1.8rem;
            }
        }

        .animated {
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <div class="container">
            <h1 class="mb-0">Dashboard</h1>
        </div>
    </div>

    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 animated">
                <div class="card text-bg-success h-100">
                    <div class="metric-card">
                        <i class="fas fa-dollar-sign icon"></i>
                        <div class="fw-bold">Faturamento (mês)</div>
                        <div class="display-6">R$ 15.847,90</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animated" style="animation-delay: 0.1s;">
                <div class="card text-bg-primary h-100">
                    <div class="metric-card">
                        <i class="fas fa-clipboard-list icon"></i>
                        <div class="fw-bold">Pedidos abertos</div>
                        <div class="display-6">24</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animated" style="animation-delay: 0.2s;">
                <div class="card text-bg-warning h-100">
                    <div class="metric-card">
                        <i class="fas fa-user-plus icon"></i>
                        <div class="fw-bold">Clientes novos</div>
                        <div class="display-6">12</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 animated" style="animation-delay: 0.3s;">
                <div class="card text-bg-danger h-100">
                    <div class="metric-card">
                        <i class="fas fa-box-open icon"></i>
                        <div class="fw-bold">Estoque baixo</div>
                        <div class="display-6">7</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container animated" style="animation-delay: 0.4s;">
            <div class="table-header">
                Vendas nos últimos dias
            </div>
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>23/05/2023</td>
                            <td>R$ 1.245,00</td>
                        </tr>
                        <tr>
                            <td>22/05/2023</td>
                            <td>R$ 2.876,50</td>
                        </tr>
                        <tr>
                            <td>21/05/2023</td>
                            <td>R$ 985,30</td>
                        </tr>
                        <tr>
                            <td>20/05/2023</td>
                            <td>R$ 3.421,75</td>
                        </tr>
                        <tr>
                            <td>19/05/2023</td>
                            <td>R$ 1.532,90</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>