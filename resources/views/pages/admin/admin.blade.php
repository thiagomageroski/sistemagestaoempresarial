<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #6c757d;
            --success: #198754;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #0dcaf0;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-width: 250px;
            --header-height: 70px;
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.6;
        }

        /* Layout */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
            cursor: pointer;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: white;
        }

        .menu-item i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        .submenu {
            padding-left: 2.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .submenu.open {
            max-height: 500px;
        }

        .submenu-item {
            padding: 0.6rem 0;
            display: block;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: var(--transition);
        }

        .submenu-item:hover {
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
        }

        /* Header */
        .admin-header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 0 1.5rem;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            color: var(--secondary);
            font-size: 1.25rem;
            cursor: pointer;
        }

        .user-menu {
            display: flex;
            align-items: center;
        }

        .user-info {
            margin-right: 1rem;
            text-align: right;
        }

        .user-name {
            font-weight: 500;
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--secondary);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Content Area */
        .content {
            padding: 1.5rem;
        }

        .page-header {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0 0 1rem 0;
            font-size: 0.9rem;
        }

        .breadcrumb-item {
            color: var(--secondary);
        }

        .breadcrumb-item:not(:last-child):after {
            content: "/";
            margin: 0 0.5rem;
        }

        .breadcrumb-item.active {
            color: var(--primary);
        }

        /* Cards */
        .card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            background-color: #f8f9fa;
        }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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

        /* Tables */
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

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: inherit;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .form-text {
            font-size: 0.85rem;
            color: var(--secondary);
            margin-top: 0.25rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn i {
            margin-right: 0.5rem;
            width: 16px;
            text-align: center;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.85rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-warning {
            background-color: var(--warning);
            color: var(--dark);
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-light {
            background-color: var(--light);
            color: var(--dark);
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-success {
            background-color: rgba(25, 135, 84, 0.1);
            color: var(--success);
        }

        .badge-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }

        .badge-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }

        .badge-info {
            background-color: rgba(13, 202, 240, 0.1);
            color: var(--info);
        }

        /* Utilities */
        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .d-flex {
            display: flex;
        }

        .align-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mt-1 {
            margin-top: 0.5rem;
        }

        .mb-1 {
            margin-bottom: 0.5rem;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }

        .p-3 {
            padding: 1rem;
        }

        /* Alertas */
        .alert {
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .alert-success {
            background-color: rgba(25, 135, 84, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        
        .alert-error, .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border-left: 4px solid var(--danger);
        }
        
        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
            border-left: 4px solid var(--warning);
        }
        
        .alert-info {
            background-color: rgba(13, 202, 240, 0.1);
            color: var(--info);
            border-left: 4px solid var(--info);
        }
        
        .alert button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            margin-left: 1rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .main-content.sidebar-open {
                margin-left: var(--sidebar-width);
            }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }
            
            .overlay.open {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2>Painel Admin</h2>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ Request::is('admin/dashboard') || Request::is('admin') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.produtos.index') }}" class="menu-item {{ Request::is('admin/produtos*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Produtos</span>
                </a>
                
                <a href="{{ route('admin.clientes.index') }}" class="menu-item {{ Request::is('admin/clientes*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Clientes</span>
                </a>
                
                <a href="{{ route('admin.pedidos.index') }}" class="menu-item {{ Request::is('admin/pedidos*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pedidos</span>
                </a>
                
                <a href="{{ route('admin.relatorios') }}" class="menu-item {{ Request::is('admin/relatorios*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Relatórios</span>
                </a>
                
                <div class="mt-4 p-3">
                    <a href="{{ route('home') }}" class="btn btn-light btn-sm" style="width: 100%">
                        <i class="fas fa-home"></i> Voltar ao Site
                    </a>
                    
                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-1">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm" style="width: 100%">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Overlay para mobile -->
        <div class="overlay" id="overlay"></div>
        
        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Header -->
            <header class="admin-header">
                <button class="toggle-sidebar" id="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="user-menu">
                    <div class="user-info">
                        <div class="user-name">{{ Session::get('user')['name'] ?? 'Administrador' }}</div>
                        <div class="user-role">{{ Session::get('user')['role'] ?? 'admin' }}</div>
                    </div>
                    <div class="user-avatar">
                        {{ substr(Session::get('user')['name'] ?? 'A', 0, 1) }}
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <div class="content">
                <!-- Exibir mensagens de flash -->
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <span>{{ Session::get('success') }}</span>
                        <button type="button" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif
                
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <span>{{ Session::get('error') }}</span>
                        <button type="button" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif
                
                @if(Session::has('warning'))
                    <div class="alert alert-warning">
                        <span>{{ Session::get('warning') }}</span>
                        <button type="button" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif
                
                @if(Session::has('info'))
                    <div class="alert alert-info">
                        <span>{{ Session::get('info') }}</span>
                        <button type="button" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif
                
                <!-- Breadcrumb -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">@yield('title', 'Página Inicial')</li>
                </ul>
                
                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                    <div>
                        @yield('actions')
                    </div>
                </div>
                
                <!-- Main Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar em dispositivos móveis
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('main-content').classList.toggle('sidebar-open');
            document.getElementById('overlay').classList.toggle('open');
        });
        
        // Fechar sidebar ao clicar no overlay
        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('main-content').classList.remove('sidebar-open');
            document.getElementById('overlay').classList.remove('open');
        });
        
        // Auto-remover alertas após 5 segundos
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.remove();
            });
        }, 5000);
    </script>
    
    @yield('scripts')
</body>
</html>