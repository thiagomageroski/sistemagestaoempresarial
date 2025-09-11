@extends('pages.admin.admin')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(67, 97, 238, 0.1); color: var(--primary);">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">154</div>
            <div class="stat-label">Pedidos Hoje</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(25, 135, 84, 0.1); color: var(--success);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">2,548</div>
            <div class="stat-label">Clientes Cadastrados</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">128</div>
            <div class="stat-label">Produtos em Estoque</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value">R$ 12.548</div>
            <div class="stat-label">Receita do Dia</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Vendas dos Últimos 7 Dias</h3>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="250"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categorias Mais Vendidas</h3>
            </div>
            <div class="card-body">
                <canvas id="categoriesChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pedidos Recentes</h3>
        <a href="#" class="btn btn-primary btn-sm">Ver Todos</a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#12345</td>
                        <td>João Silva</td>
                        <td>10/05/2023</td>
                        <td>R$ 299,90</td>
                        <td><span class="badge badge-success">Entregue</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>#12346</td>
                        <td>Maria Santos</td>
                        <td>10/05/2023</td>
                        <td>R$ 599,90</td>
                        <td><span class="badge badge-warning">Processando</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>#12347</td>
                        <td>Pedro Oliveira</td>
                        <td>09/05/2023</td>
                        <td>R$ 1.299,90</td>
                        <td><span class="badge badge-info">Enviado</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>#12348</td>
                        <td>Ana Costa</td>
                        <td>09/05/2023</td>
                        <td>R$ 199,90</td>
                        <td><span class="badge badge-danger">Cancelado</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de vendas
    const salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Vendas (R$)',
                data: [1250, 1900, 2100, 1800, 2500, 2200, 2800],
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // Gráfico de categorias
    const categoriesChart = new Chart(document.getElementById('categoriesChart'), {
        type: 'doughnut',
        data: {
            labels: ['Eletrônicos', 'Roupas', 'Casa', 'Esportes'],
            datasets: [{
                data: [35, 25, 20, 20],
                backgroundColor: [
                    '#4361ee',
                    '#6c757d',
                    '#198754',
                    '#ffc107'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection