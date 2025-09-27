@extends('pages.admin.admin')

@section('title', 'Dashboard')

@section('actions')
    <button class="btn btn-primary" onclick="refreshDashboard()">
        <i class="fas fa-sync-alt"></i> Atualizar
    </button>
@endsection

@section('content')
<!-- Stats Grid -->
<div class="stats-grid" id="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(67, 97, 238, 0.1); color: var(--primary);">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value" id="vendas-hoje">0</div>
            <div class="stat-label">Pedidos Hoje</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(25, 135, 84, 0.1); color: var(--success);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value" id="clientes-cadastrados">0</div>
            <div class="stat-label">Clientes Cadastrados</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value" id="produtos-estoque">0</div>
            <div class="stat-label">Produtos em Estoque</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="stat-info">
            <div class="stat-value" id="receita-dia">R$ 0</div>
            <div class="stat-label">Receita do Dia</div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1.5rem;">
    <div style="flex: 2; min-width: 300px;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Vendas dos Últimos 7 Dias</h3>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="250"></canvas>
            </div>
        </div>
    </div>
    
    <div style="flex: 1; min-width: 300px;">
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

<!-- Recent Orders -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pedidos Recentes</h3>
        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-primary btn-sm">Ver Todos</a>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table id="recent-orders-table">
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
                        <td colspan="6" class="text-center">Carregando pedidos...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ações Rápidas</h3>
    </div>
    <div class="card-body">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Adicionar Produto
            </a>
            <a href="{{ route('admin.clientes.index') }}" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Gerenciar Clientes
            </a>
            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-info">
                <i class="fas fa-shopping-cart"></i> Ver Todos os Pedidos
            </a>
            <a href="{{ route('admin.relatorios') }}" class="btn btn-warning">
                <i class="fas fa-chart-line"></i> Relatórios
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Variáveis globais para os gráficos
    let salesChart, categoriesChart;

    // Carregar dados do dashboard
    function loadDashboardData() {
        // Fazer requisição para a API de métricas
        fetch('{{ route("admin.api.metricas") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) throw new Error('Erro ao carregar métricas');
            return response.json();
        })
        .then(data => {
            // Atualizar estatísticas
            document.getElementById('vendas-hoje').textContent = data.vendas_hoje.toLocaleString();
            document.getElementById('clientes-cadastrados').textContent = data.clientes_cadastrados.toLocaleString();
            document.getElementById('produtos-estoque').textContent = data.produtos_estoque.toLocaleString();
            document.getElementById('receita-dia').textContent = 'R$ ' + data.receita_dia.toLocaleString('pt-BR', {minimumFractionDigits: 2});
            
            // Atualizar gráfico de vendas
            updateSalesChart(data.vendas_semana);
            
            // Atualizar gráfico de categorias
            updateCategoriesChart(data.categorias);
        })
        .catch(error => {
            console.error('Erro ao carregar métricas:', error);
            showAlert('error', 'Erro ao carregar dados do dashboard. Verifique o console para mais detalhes.');
        });
            
        // Carregar pedidos recentes
        loadRecentOrders();
    }
    
    // Carregar pedidos recentes
    function loadRecentOrders() {
        fetch('{{ route("admin.api.vendas.recentes") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) throw new Error('Erro ao carregar pedidos');
            return response.json();
        })
        .then(orders => {
            const tbody = document.querySelector('#recent-orders-table tbody');
            tbody.innerHTML = '';
            
            if (orders.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">Nenhum pedido encontrado</td></tr>';
                return;
            }
            
            orders.forEach(order => {
                const statusClass = getStatusClass(order.status);
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${order.id}</td>
                    <td>${order.cliente}</td>
                    <td>${order.data}</td>
                    <td>${order.valor}</td>
                    <td><span class="badge ${statusClass}">${formatStatus(order.status)}</span></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                    </td>
                `;
                
                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar pedidos:', error);
            document.querySelector('#recent-orders-table tbody').innerHTML = 
                '<tr><td colspan="6" class="text-center">Erro ao carregar pedidos</td></tr>';
        });
    }
    
    // Atualizar gráfico de vendas
    function updateSalesChart(salesData) {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        if (salesChart) {
            salesChart.destroy();
        }
        
        salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                datasets: [{
                    label: 'Vendas (R$)',
                    data: [
                        salesData.seg || 0,
                        salesData.ter || 0,
                        salesData.qua || 0,
                        salesData.qui || 0,
                        salesData.sex || 0,
                        salesData.sab || 0,
                        salesData.dom || 0
                    ],
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
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value.toLocaleString('pt-BR');
                            }
                        }
                    }
                }
            }
        });
    }
    
    // Atualizar gráfico de categorias
    function updateCategoriesChart(categoriesData) {
        const ctx = document.getElementById('categoriesChart').getContext('2d');
        
        if (categoriesChart) {
            categoriesChart.destroy();
        }
        
        // Preparar dados para o gráfico
        const labels = [];
        const data = [];
        const backgroundColors = [
            '#4361ee', '#6c757d', '#198754', '#ffc107', 
            '#0dcaf0', '#6610f2', '#fd7e14', '#20c997'
        ];
        
        for (const [category, value] of Object.entries(categoriesData)) {
            labels.push(formatCategoryName(category));
            data.push(value);
        }
        
        categoriesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors.slice(0, labels.length)
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
    }
    
    // Função auxiliar para formatar nome da categoria
    function formatCategoryName(category) {
        const names = {
            'eletronicos': 'Eletrônicos',
            'roupas': 'Roupas',
            'casa': 'Casa',
            'esportes': 'Esportes'
        };
        
        return names[category] || category.charAt(0).toUpperCase() + category.slice(1);
    }
    
    // Função auxiliar para obter classe CSS baseada no status
    function getStatusClass(status) {
        const statusClasses = {
            'pendente': 'badge-warning',
            'processando': 'badge-info',
            'enviado': 'badge-primary',
            'entregue': 'badge-success',
            'cancelado': 'badge-danger'
        };
        
        return statusClasses[status] || 'badge-secondary';
    }
    
    // Função auxiliar para formatar texto do status
    function formatStatus(status) {
        const statusNames = {
            'pendente': 'Pendente',
            'processando': 'Processando',
            'enviado': 'Enviado',
            'entregue': 'Entregue',
            'cancelado': 'Cancelado'
        };
        
        return statusNames[status] || status;
    }
    
    // Função para atualizar o dashboard
    function refreshDashboard() {
        showAlert('info', 'Atualizando dados...');
        
        // Recarregar dados
        loadDashboardData();
        
        // Remover alerta de carregamento após 2 segundos
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.textContent.includes('Atualizando')) {
                    alert.remove();
                }
            });
        }, 2000);
    }
    
    // Função para exibir alertas
    function showAlert(type, message) {
        // Remover alertas existentes do mesmo tipo
        const existingAlerts = document.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        // Criar novo alerta
        const alert = document.createElement('div');
        alert.className = `alert alert-${type}`;
        alert.innerHTML = `
            <span>${message}</span>
            <button type="button" onclick="this.parentElement.remove()">&times;</button>
        `;
        
        // Adicionar ao conteúdo
        document.querySelector('.content').prepend(alert);
        
        // Remover automaticamente após 5 segundos
        setTimeout(() => {
            if (alert.parentElement) {
                alert.remove();
            }
        }, 5000);
    }
    
    // Inicializar dashboard quando a página carregar
    document.addEventListener('DOMContentLoaded', function() {
        loadDashboardData();
    });
</script>

<style>
    /* Estilos adicionais para o dashboard */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.5rem;
    }
    
    .stat-info {
        flex: 1;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        color: var(--secondary);
        font-size: 0.9rem;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    
    th {
        font-weight: 500;
        background-color: #f8f9fa;
    }
    
    tr:hover {
        background-color: #f8f9fa;
    }
    
    .text-center {
        text-align: center;
    }
    
    /* Responsividade */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-card {
            padding: 1rem;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }
        
        .stat-value {
            font-size: 1.25rem;
        }
    }
</style>
@endsection