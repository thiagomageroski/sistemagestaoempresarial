<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - TechStore</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #c7d2fe;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #1f2937;
            --dark-gray: #4b5563;
            --gray: #9ca3af;
            --light-gray: #e5e7eb;
            --light: #f3f4f6;
            --lighter: #f9fafb;
            --danger: #ef4444;
            --success: #10b981;
            --warning: #f59e0b;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            color: var(--dark);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 25px 50px rgba(31, 38, 135, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-radius: 20px;
        }
        
        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 70px rgba(31, 38, 135, 0.12);
            border-color: rgba(99, 102, 241, 0.25);
        }
        
        .nav-tab {
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
            border-radius: 14px;
            margin-bottom: 8px;
        }
        
        .nav-tab::before {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            opacity: 0.08;
            transition: left 0.5s ease;
            z-index: 0;
        }
        
        .nav-tab::after {
            content: '';
            position: absolute;
            left: -100%;
            bottom: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            transition: left 0.5s ease;
        }
        
        .nav-tab.active {
            color: var(--primary);
            background: rgba(99, 102, 241, 0.05);
            font-weight: 600;
        }
        
        .nav-tab.active::before,
        .nav-tab.active::after {
            left: 0;
        }
        
        .nav-tab:hover::before {
            left: 0;
        }
        
        .avatar-container {
            position: relative;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        .avatar-container:hover {
            transform: scale(1.08);
        }
        
        .avatar-container:hover .avatar-overlay {
            opacity: 1;
        }
        
        .avatar-image {
            border: 5px solid white;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
        }
        
        .avatar-container:hover .avatar-image {
            border-color: var(--primary-light);
            box-shadow: 0 20px 50px rgba(99, 102, 241, 0.25);
        }
        
        .avatar-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.9) 0%, rgba(79, 70, 229, 0.9) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
            position: relative;
            overflow: hidden;
            border-radius: 14px;
            font-weight: 600;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s ease;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
        }
        
        .btn-secondary {
            background: white;
            border: 2px solid var(--light-gray);
            color: var(--dark);
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
            border-radius: 14px;
            font-weight: 600;
        }
        
        .btn-secondary:hover {
            background: var(--lighter);
            border-color: var(--gray);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .input-field {
            transition: all 0.3s ease;
            border: 2px solid var(--light-gray);
            background: var(--lighter);
            border-radius: 14px;
        }
        
        .input-field:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background: white;
            transform: translateY(-2px);
        }
        
        .toggle-checkbox:checked {
            background: var(--primary);
        }
        
        .toggle-checkbox:checked + .toggle-label {
            background: var(--primary);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 18px;
            padding: 1.75rem;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        
        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }
        
        .section-divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, var(--light-gray) 50%, transparent 100%);
            margin: 2.5rem 0;
        }
        
        .floating-label {
            position: relative;
            margin-bottom: 2rem;
        }
        
        .floating-label input {
            padding-top: 1.8rem;
            padding-bottom: 1rem;
            border-radius: 14px;
            font-size: 1rem;
        }
        
        .floating-label label {
            position: absolute;
            top: 1rem;
            left: 1.2rem;
            font-size: 1rem;
            color: var(--dark-gray);
            transition: all 0.3s ease;
            pointer-events: none;
            background: linear-gradient(180deg, var(--lighter) 0%, white 50%);
            padding: 0 0.5rem;
            margin-left: -0.5rem;
        }
        
        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            top: 0.3rem;
            font-size: 0.85rem;
            color: var(--primary);
            font-weight: 600;
        }
        
        .secao {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .secao.ativa {
            display: block;
        }
        
        .endereco-item, .cartao-item {
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 18px;
            overflow: hidden;
        }
        
        .endereco-item:hover, .cartao-item:hover {
            transform: translateX(10px) translateY(-4px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-light);
        }
        
        .preference-item {
            transition: all 0.3s ease;
            border-radius: 14px;
            border: 1px solid transparent;
        }
        
        .preference-item:hover {
            background: rgba(99, 102, 241, 0.03);
            border-color: rgba(99, 102, 241, 0.1);
            transform: translateY(-3px);
        }
        
        .badge-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-size: 0.85rem;
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.2);
        }
        
        .badge-secondary {
            background: linear-gradient(135deg, var(--success) 0%, #0d966c 100%);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-size: 0.85rem;
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .page-title {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .success-message {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border: 1px solid #34d399;
            border-left: 5px solid #10b981;
            border-radius: 16px;
        }
        
        .error-message {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 1px solid #f87171;
            border-left: 5px solid #ef4444;
            border-radius: 16px;
        }
        
        .empty-state {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px dashed var(--light-gray);
            border-radius: 20px;
        }
        
        .form-section {
            border-radius: 20px;
            overflow: hidden;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 2rem;
            border-top: 1px solid var(--light-gray);
        }
        
        .icon-container {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(79, 70, 229, 0.1) 100%);
            border-radius: 16px;
            padding: 1rem;
        }
        
        .nav-icon {
            color: var(--primary);
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .section-icon {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }
            
            .glass-card {
                margin: 0.5rem;
                padding: 1.5rem;
            }
            
            .avatar-container {
                width: 120px;
                height: 120px;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    @include('partials.navbar')
    
    <main class="flex-grow container mx-auto px-4 py-8 mt-16">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold mb-4 page-title">Meu Perfil</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Gerencie suas informações pessoais, preferências e configure sua conta de forma segura e intuitiva
                </p>
            </div>
            
            <!-- Mensagens de sucesso/erro -->
            @if(session('success'))
                <div class="success-message px-8 py-6 mb-8 flex items-center animate-fade-in">
                    <i class="fas fa-check-circle text-2xl mr-4 text-green-600"></i>
                    <div>
                        <h3 class="font-semibold text-green-800">Sucesso!</h3>
                        <p class="text-green-700 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="error-message px-8 py-6 mb-8 flex items-center animate-fade-in">
                    <i class="fas fa-exclamation-circle text-2xl mr-4 text-red-600"></i>
                    <div>
                        <h3 class="font-semibold text-red-800">Ops, algo deu errado!</h3>
                        <p class="text-red-700 mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
            
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar de Navegação -->
                <div class="w-full lg:w-1/4">
                    <div class="glass-card rounded-2xl p-8 mb-8">
                        <div class="flex flex-col items-center mb-8">
                            <div class="avatar-container relative mb-6">
                                <div class="w-32 h-32 rounded-full avatar-image overflow-hidden">
                                    <img src="{{ $perfil['avatar'] ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80' }}" 
                                         alt="Avatar" class="w-full h-full object-cover">
                                </div>
                                <div class="avatar-overlay rounded-full">
                                    <i class="fas fa-camera text-white text-3xl"></i>
                                </div>
                                <input type="file" id="avatar-upload-input" class="hidden" accept="image/*">
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">{{ $user['name'] }}</h2>
                            <p class="text-primary text-lg font-medium">{{ $user['email'] }}</p>
                            <span class="mt-4 badge-primary">
                                <i class="fas fa-crown mr-2"></i>
                                {{ $user['role'] === 'admin' ? 'Administrador' : 'Cliente Premium' }}
                            </span>
                        </div>
                        
                        <nav class="space-y-2">
                            <a href="#informacoes" class="nav-tab active flex items-center px-5 py-4 text-gray-700" data-target="informacoes">
                                <i class="fas fa-user-circle nav-icon mr-4"></i>
                                <span class="font-medium">Informações Pessoais</span>
                            </a>
                            <a href="#seguranca" class="nav-tab flex items-center px-5 py-4 text-gray-700" data-target="seguranca">
                                <i class="fas fa-lock nav-icon mr-4"></i>
                                <span class="font-medium">Segurança</span>
                            </a>
                            <a href="#preferencias" class="nav-tab flex items-center px-5 py-4 text-gray-700" data-target="preferencias">
                                <i class="fas fa-bell nav-icon mr-4"></i>
                                <span class="font-medium">Preferências</span>
                            </a>
                            <a href="#enderecos" class="nav-tab flex items-center px-5 py-4 text-gray-700" data-target="enderecos">
                                <i class="fas fa-map-marker-alt nav-icon mr-4"></i>
                                <span class="font-medium">Endereços</span>
                            </a>
                            <a href="#pagamentos" class="nav-tab flex items-center px-5 py-4 text-gray-700" data-target="pagamentos">
                                <i class="fas fa-credit-card nav-icon mr-4"></i>
                                <span class="font-medium">Pagamentos</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="glass-card rounded-2xl p-8">
                        <h3 class="font-bold text-gray-800 mb-6 flex items-center text-lg">
                            <i class="fas fa-chart-line mr-3 text-primary"></i>
                            Estatísticas da Conta
                        </h3>
                        <div class="space-y-5">
                            <div class="stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Pedidos Realizados</p>
                                        <p class="text-2xl font-bold text-primary">{{ $totalPedidos }}</p>
                                    </div>
                                    <i class="fas fa-shopping-bag text-2xl text-primary opacity-70"></i>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Membro desde</p>
                                        <p class="text-2xl font-bold text-primary">{{ \Carbon\Carbon::parse($user['created_at'])->format('M Y') }}</p>
                                    </div>
                                    <i class="fas fa-calendar-alt text-2xl text-primary opacity-70"></i>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Último acesso</p>
                                        <p class="text-2xl font-bold text-primary">Hoje, {{ date('H:i') }}</p>
                                    </div>
                                    <i class="fas fa-clock text-2xl text-primary opacity-70"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Conteúdo Principal -->
                <div class="w-full lg:w-3/4">
                    <!-- Informações Pessoais -->
                    <div id="informacoes" class="secao ativa glass-card rounded-2xl p-10 mb-8">
                        <div class="section-header">
                            <h2 class="section-title">
                                <i class="fas fa-user-circle section-icon"></i>
                                Informações Pessoais
                            </h2>
                            <div class="icon-container">
                                <i class="fas fa-id-card text-primary text-2xl"></i>
                            </div>
                        </div>
                        
                        <form action="{{ route('perfil.update') }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="floating-label">
                                    <input type="text" name="nome" value="{{ $perfil['nome'] }}" 
                                           class="input-field w-full px-5 py-4"
                                           placeholder=" " required>
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="floating-label">
                                    <input type="text" name="sobrenome" value="{{ $perfil['sobrenome'] }}" 
                                           class="input-field w-full px-5 py-4"
                                           placeholder=" ">
                                    <label for="sobrenome">Sobrenome</label>
                                </div>
                            </div>
                            
                            <div class="floating-label">
                                <input type="email" value="{{ $user['email'] }}" disabled
                                       class="input-field w-full px-5 py-4 bg-gray-50 cursor-not-allowed"
                                       placeholder=" ">
                                <label for="email">E-mail</label>
                                <p class="text-sm text-gray-500 mt-3 flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-primary"></i> 
                                    O e-mail não pode ser alterado por questões de segurança
                                </p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="floating-label">
                                    <input type="tel" name="telefone" value="{{ $perfil['telefone'] }}" 
                                           class="input-field w-full px-5 py-4"
                                           placeholder=" ">
                                    <label for="telefone">Telefone</label>
                                </div>
                                <div class="floating-label">
                                    <input type="date" name="data_nascimento" value="{{ $perfil['data_nascimento'] }}" 
                                           class="input-field w-full px-5 py-4"
                                           placeholder=" ">
                                    <label for="data_nascimento">Data de Nascimento</label>
                                </div>
                            </div>
                            
                            <hr class="section-divider">
                            
                            <div class="action-buttons">
                                <button type="button" class="btn-secondary px-8 py-4 transition-all duration-300 flex items-center font-medium" onclick="resetForm('informacoes')">
                                    <i class="fas fa-times mr-3"></i> Cancelar
                                </button>
                                <button type="submit" class="btn-primary px-8 py-4 text-white flex items-center font-medium">
                                    <i class="fas fa-save mr-3"></i> Salvar Alterações
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Alterar Senha -->
                    <div id="seguranca" class="secao glass-card rounded-2xl p-10 mb-8">
                        <div class="section-header">
                            <h2 class="section-title">
                                <i class="fas fa-lock section-icon"></i>
                                Segurança da Conta
                            </h2>
                            <div class="icon-container">
                                <i class="fas fa-shield-alt text-primary text-2xl"></i>
                            </div>
                        </div>
                        
                        <form action="{{ route('perfil.update-password') }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="floating-label">
                                    <input type="password" name="senha_atual" 
                                           class="input-field w-full px-5 py-4"
                                           placeholder=" " required>
                                    <label for="senha_atual">Senha Atual</label>
                                </div>
                                <div class="floating-label">
                                    <input type="password" name="nova_senha" 
                                           class="input-field w-full px-5 py-4"
                                           placeholder=" " required>
                                    <label for="nova_senha">Nova Senha</label>
                                </div>
                                <div class="floating-label md:col-span-2">
                                    <input type="password" name="nova_senha_confirmation" 
                                           class="input-field w-full px-5 py-4"
                                           placeholder=" " required>
                                    <label for="nova_senha_confirmation">Confirmar Nova Senha</label>
                                </div>
                            </div>
                            
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                                <h4 class="font-semibold text-blue-800 mb-2 flex items-center">
                                    <i class="fas fa-lightbulb mr-2"></i> Dicas para uma senha segura
                                </h4>
                                <ul class="text-blue-700 text-sm space-y-1">
                                    <li>• Use pelo menos 8 caracteres</li>
                                    <li>• Combine letras maiúsculas e minúsculas</li>
                                    <li>• Inclua números e caracteres especiais</li>
                                    <li>• Evite informações pessoais óbvias</li>
                                </ul>
                            </div>
                            
                            <hr class="section-divider">
                            
                            <div class="action-buttons">
                                <button type="button" class="btn-secondary px-8 py-4 transition-all duration-300 flex items-center font-medium" onclick="resetForm('seguranca')">
                                    <i class="fas fa-times mr-3"></i> Cancelar
                                </button>
                                <button type="submit" class="btn-primary px-8 py-4 text-white flex items-center font-medium">
                                    <i class="fas fa-key mr-3"></i> Atualizar Senha
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Preferências de Comunicação -->
                    <div id="preferencias" class="secao glass-card rounded-2xl p-10 mb-8">
                        <div class="section-header">
                            <h2 class="section-title">
                                <i class="fas fa-bell section-icon"></i>
                                Preferências de Comunicação
                            </h2>
                            <div class="icon-container">
                                <i class="fas fa-cogs text-primary text-2xl"></i>
                            </div>
                        </div>
                        
                        <form action="{{ route('perfil.update') }}" method="POST">
                            @csrf
                            <div class="space-y-6">
                                <div class="preference-item p-6 rounded-xl">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-800 text-lg">E-mails Promocionais</h3>
                                            <p class="text-gray-600 mt-2">Receba ofertas exclusivas, novidades e descontos especiais diretamente no seu e-mail</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="email_promocional" value="1" 
                                                   class="sr-only peer" {{ $perfil['preferencias']['email_promocional'] ? 'checked' : '' }}>
                                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-7 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="preference-item p-6 rounded-xl">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-800 text-lg">Notificações por SMS</h3>
                                            <p class="text-gray-600 mt-2">Receba alertas importantes sobre seus pedidos e promoções via SMS</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="notificacao_sms" value="1" 
                                                   class="sr-only peer" {{ $perfil['preferencias']['notificacao_sms'] ? 'checked' : '' }}>
                                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-7 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="preference-item p-6 rounded-xl">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-800 text-lg">Notificações por Push</h3>
                                            <p class="text-gray-600 mt-2">Permita notificações no navegador para acompanhar seus pedidos em tempo real</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="notificacao_push" value="1" 
                                                   class="sr-only peer" {{ $perfil['preferencias']['notificacao_push'] ? 'checked' : '' }}>
                                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-7 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="section-divider">
                            
                            <div class="action-buttons">
                                <button type="button" class="btn-secondary px-8 py-4 transition-all duration-300 flex items-center font-medium" onclick="resetForm('preferencias')">
                                    <i class="fas fa-times mr-3"></i> Cancelar
                                </button>
                                <button type="submit" class="btn-primary px-8 py-4 text-white flex items-center font-medium">
                                    <i class="fas fa-sync-alt mr-3"></i> Salvar Preferências
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Endereços -->
                    <div id="enderecos" class="secao glass-card rounded-2xl p-10 mb-8">
                        <div class="section-header">
                            <h2 class="section-title">
                                <i class="fas fa-map-marker-alt section-icon"></i>
                                Meus Endereços
                            </h2>
                            <div class="flex items-center space-x-4">
                                <div class="icon-container">
                                    <i class="fas fa-home text-primary text-2xl"></i>
                                </div>
                                <button class="btn-primary px-6 py-3 text-white flex items-center font-medium" onclick="adicionarEndereco()">
                                    <i class="fas fa-plus mr-2"></i> Novo Endereço
                                </button>
                            </div>
                        </div>
                        
                        <div class="space-y-6" id="lista-enderecos">
                            <!-- Endereços serão carregados aqui -->
                        </div>
                        
                        <!-- Formulário de Endereço -->
                        <div id="form-endereco" class="hidden mt-8 p-8 border-2 border-dashed border-primary border-opacity-20 rounded-2xl glass-card">
                            <h3 class="font-bold text-2xl text-gray-800 mb-6 flex items-center" id="titulo-form-endereco">
                                <i class="fas fa-plus-circle mr-3 text-primary"></i>
                                Adicionar Endereço
                            </h3>
                            <form id="endereco-form" class="space-y-6">
                                <input type="hidden" id="endereco-id" name="id" value="">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="floating-label">
                                        <input type="text" id="endereco-cep" name="cep" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="endereco-cep">CEP</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="endereco-apelido" name="apelido" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="endereco-apelido">Apelido (Ex: Casa, Trabalho)</label>
                                    </div>
                                </div>
                                
                                <div class="floating-label">
                                    <input type="text" id="endereco-logradouro" name="logradouro" class="input-field w-full px-4 py-3" placeholder=" " required>
                                    <label for="endereco-logradouro">Endereço</label>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="floating-label">
                                        <input type="text" id="endereco-numero" name="numero" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="endereco-numero">Número</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="endereco-complemento" name="complemento" class="input-field w-full px-4 py-3" placeholder=" ">
                                        <label for="endereco-complemento">Complemento</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="endereco-bairro" name="bairro" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="endereco-bairro">Bairro</label>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="floating-label">
                                        <input type="text" id="endereco-cidade" name="cidade" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="endereco-cidade">Cidade</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="endereco-estado" name="estado" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="endereco-estado">Estado</label>
                                    </div>
                                </div>
                                
                                <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                                    <input type="checkbox" id="endereco-principal" name="principal" class="mr-3 w-5 h-5 text-primary">
                                    <label for="endereco-principal" class="text-gray-700 font-medium">Definir como endereço principal</label>
                                </div>
                                
                                <div class="flex justify-end space-x-4 pt-4">
                                    <button type="button" class="btn-secondary px-6 py-3 font-medium" onclick="cancelarEndereco()">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn-primary px-6 py-3 text-white font-medium">
                                        <span id="texto-botao-endereco">Salvar Endereço</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Pagamentos -->
                    <div id="pagamentos" class="secao glass-card rounded-2xl p-10">
                        <div class="section-header">
                            <h2 class="section-title">
                                <i class="fas fa-credit-card section-icon"></i>
                                Meus Cartões
                            </h2>
                            <div class="flex items-center space-x-4">
                                <div class="icon-container">
                                    <i class="fas fa-wallet text-primary text-2xl"></i>
                                </div>
                                <button class="btn-primary px-6 py-3 text-white flex items-center font-medium" onclick="adicionarCartao()">
                                    <i class="fas fa-plus mr-2"></i> Novo Cartão
                                </button>
                            </div>
                        </div>
                        
                        <div class="space-y-6" id="lista-cartoes">
                            <!-- Cartões serão carregados aqui -->
                        </div>
                        
                        <!-- Formulário de Cartão -->
                        <div id="form-cartao" class="hidden mt-8 p-8 border-2 border-dashed border-primary border-opacity-20 rounded-2xl glass-card">
                            <h3 class="font-bold text-2xl text-gray-800 mb-6 flex items-center" id="titulo-form-cartao">
                                <i class="fas fa-credit-card mr-3 text-primary"></i>
                                Adicionar Cartão
                            </h3>
                            <form id="cartao-form" class="space-y-6">
                                <input type="hidden" id="cartao-id" name="id" value="">
                                
                                <div class="floating-label">
                                    <input type="text" id="cartao-numero" name="numero" class="input-field w-full px-4 py-3" placeholder=" " required>
                                    <label for="cartao-numero">Número do Cartão</label>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="floating-label">
                                        <input type="text" id="cartao-titular" name="titular" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="cartao-titular">Nome do Titular</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="cartao-validade" name="validade" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="cartao-validade">Validade (MM/AA)</label>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="floating-label">
                                        <input type="text" id="cartao-cvv" name="cvv" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="cartao-cvv">CVV</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="cartao-apelido" name="apelido" class="input-field w-full px-4 py-3" placeholder=" " required>
                                        <label for="cartao-apelido">Apelido (Ex: Cartão Principal)</label>
                                    </div>
                                </div>
                                
                                <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                                    <input type="checkbox" id="cartao-principal" name="principal" class="mr-3 w-5 h-5 text-primary">
                                    <label for="cartao-principal" class="text-gray-700 font-medium">Definir como cartão principal</label>
                                </div>
                                
                                <div class="flex justify-end space-x-4 pt-4">
                                    <button type="button" class="btn-secondary px-6 py-3 font-medium" onclick="cancelarCartao()">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn-primary px-6 py-3 text-white font-medium">
                                        <span id="texto-botao-cartao">Salvar Cartão</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    @include('partials.footer')

    <script>
        // Dados de exemplo (em um sistema real, isso viria do backend)
        let enderecos = [
            {
                id: 1,
                apelido: 'Casa',
                logradouro: 'Rua das Flores, 123',
                complemento: 'Apto 101',
                bairro: 'Centro',
                cidade: 'São Paulo',
                estado: 'SP',
                cep: '01234-567',
                principal: true
            },
            {
                id: 2,
                apelido: 'Trabalho',
                logradouro: 'Av. Paulista, 1000',
                complemento: '',
                bairro: 'Bela Vista',
                cidade: 'São Paulo',
                estado: 'SP',
                cep: '01310-100',
                principal: false
            }
        ];

        let cartoes = [
            {
                id: 1,
                apelido: 'Cartão Principal',
                numero: '**** **** **** 1234',
                titular: 'João Silva',
                validade: '12/2025',
                principal: true
            }
        ];

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            carregarEnderecos();
            carregarCartoes();
            
            // Configurar formulários
            document.getElementById('endereco-form').addEventListener('submit', salvarEndereco);
            document.getElementById('cartao-form').addEventListener('submit', salvarCartao);
            
            // Configurar navegação por abas
            const navTabs = document.querySelectorAll('.nav-tab');
            navTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove a classe ativa de todas as abas
                    navTabs.forEach(t => t.classList.remove('active'));
                    
                    // Adiciona a classe ativa à aba clicada
                    this.classList.add('active');
                    
                    // Mostra a seção correspondente
                    const targetId = this.getAttribute('data-target');
                    mostrarSecao(targetId);
                });
            });
            
            // Upload de avatar
            const avatarUpload = document.querySelector('.avatar-container');
            const avatarInput = document.getElementById('avatar-upload-input');
            
            avatarUpload.addEventListener('click', function() {
                avatarInput.click();
            });
            
            avatarInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const formData = new FormData();
                    formData.append('avatar', this.files[0]);
                    
                    fetch("{{ route('perfil.upload-avatar') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Atualizar a imagem do avatar
                            const avatarImg = avatarUpload.querySelector('img');
                            avatarImg.src = data.avatar_url;
                            
                            // Mostrar mensagem de sucesso
                            mostrarToast('Avatar atualizado com sucesso!', 'success');
                        } else {
                            mostrarToast('Erro ao atualizar avatar: ' + data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        mostrarToast('Erro ao atualizar avatar', 'error');
                    });
                }
            });
        });

        // ===== FUNÇÕES PARA ENDEREÇOS =====
        function carregarEnderecos() {
            const lista = document.getElementById('lista-enderecos');
            lista.innerHTML = '';
            
            if (enderecos.length === 0) {
                lista.innerHTML = `
                    <div class="empty-state text-center py-12">
                        <i class="fas fa-map-marker-alt text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Nenhum endereço cadastrado</h3>
                        <p class="text-gray-500">Adicione seu primeiro endereço para facilitar suas compras</p>
                    </div>
                `;
                return;
            }
            
            enderecos.forEach(endereco => {
                const enderecoHTML = `
                    <div class="endereco-item p-6 glass-card" data-id="${endereco.id}">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-primary text-xl mr-3"></i>
                                <h3 class="font-semibold text-gray-800 text-lg">${endereco.apelido}</h3>
                            </div>
                            ${endereco.principal ? '<span class="badge-primary">Principal</span>' : ''}
                        </div>
                        <div class="space-y-2 text-gray-600">
                            <p class="flex items-center">
                                <i class="fas fa-road mr-2 w-4 text-center"></i>
                                ${endereco.logradouro}${endereco.complemento ? ', ' + endereco.complemento : ''}
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-city mr-2 w-4 text-center"></i>
                                ${endereco.bairro}, ${endereco.cidade} - ${endereco.estado}
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-mail-bulk mr-2 w-4 text-center"></i>
                                CEP: ${endereco.cep}
                            </p>
                        </div>
                        <div class="flex space-x-3 mt-4">
                            <button class="text-primary hover:text-primary-dark font-medium flex items-center" onclick="editarEndereco(${endereco.id})">
                                <i class="fas fa-edit mr-2"></i> Editar
                            </button>
                            <button class="text-danger hover:text-red-800 font-medium flex items-center" onclick="excluirEndereco(${endereco.id})">
                                <i class="fas fa-trash mr-2"></i> Excluir
                            </button>
                        </div>
                    </div>
                `;
                lista.innerHTML += enderecoHTML;
            });
        }

        function adicionarEndereco() {
            document.getElementById('endereco-id').value = '';
            document.getElementById('endereco-form').reset();
            document.getElementById('titulo-form-endereco').innerHTML = '<i class="fas fa-plus-circle mr-3 text-primary"></i>Adicionar Endereço';
            document.getElementById('texto-botao-endereco').textContent = 'Salvar Endereço';
            document.getElementById('form-endereco').classList.remove('hidden');
            document.getElementById('form-endereco').scrollIntoView({ behavior: 'smooth' });
        }

        function editarEndereco(id) {
            const endereco = enderecos.find(e => e.id === id);
            if (endereco) {
                document.getElementById('endereco-id').value = endereco.id;
                document.getElementById('endereco-apelido').value = endereco.apelido;
                document.getElementById('endereco-logradouro').value = endereco.logradouro;
                document.getElementById('endereco-numero').value = endereco.numero || '';
                document.getElementById('endereco-complemento').value = endereco.complemento || '';
                document.getElementById('endereco-bairro').value = endereco.bairro;
                document.getElementById('endereco-cidade').value = endereco.cidade;
                document.getElementById('endereco-estado').value = endereco.estado;
                document.getElementById('endereco-cep').value = endereco.cep;
                document.getElementById('endereco-principal').checked = endereco.principal;
                
                document.getElementById('titulo-form-endereco').innerHTML = '<i class="fas fa-edit mr-3 text-primary"></i>Editar Endereço';
                document.getElementById('texto-botao-endereco').textContent = 'Atualizar Endereço';
                document.getElementById('form-endereco').classList.remove('hidden');
                document.getElementById('form-endereco').scrollIntoView({ behavior: 'smooth' });
            }
        }

        function salvarEndereco(e) {
            e.preventDefault();
            
            const id = document.getElementById('endereco-id').value;
            const formData = new FormData(e.target);
            const isPrincipal = formData.get('principal') === 'on';
            
            // Se marcar como principal, remove principal dos outros
            if (isPrincipal) {
                enderecos.forEach(e => e.principal = false);
            }
            
            const enderecoData = {
                id: id ? parseInt(id) : Date.now(),
                apelido: formData.get('apelido'),
                logradouro: formData.get('logradouro'),
                numero: formData.get('numero'),
                complemento: formData.get('complemento'),
                bairro: formData.get('bairro'),
                cidade: formData.get('cidade'),
                estado: formData.get('estado'),
                cep: formData.get('cep'),
                principal: isPrincipal
            };
            
            if (id) {
                // Editar endereço existente
                const index = enderecos.findIndex(e => e.id === parseInt(id));
                if (index !== -1) {
                    enderecos[index] = enderecoData;
                }
            } else {
                // Adicionar novo endereço
                enderecos.push(enderecoData);
            }
            
            carregarEnderecos();
            cancelarEndereco();
            mostrarToast('Endereço salvo com sucesso!', 'success');
        }

        function excluirEndereco(id) {
            if (confirm('Tem certeza que deseja excluir este endereço?')) {
                enderecos = enderecos.filter(e => e.id !== id);
                carregarEnderecos();
                mostrarToast('Endereço excluído com sucesso!', 'success');
            }
        }

        function cancelarEndereco() {
            document.getElementById('form-endereco').classList.add('hidden');
        }

        // ===== FUNÇÕES PARA CARTÕES =====
        function carregarCartoes() {
            const lista = document.getElementById('lista-cartoes');
            lista.innerHTML = '';
            
            if (cartoes.length === 0) {
                lista.innerHTML = `
                    <div class="empty-state text-center py-12">
                        <i class="fas fa-credit-card text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Nenhum cartão cadastrado</h3>
                        <p class="text-gray-500">Adicione seu primeiro cartão para agilizar suas compras</p>
                    </div>
                `;
                return;
            }
            
            cartoes.forEach(cartao => {
                const cartaoHTML = `
                    <div class="cartao-item p-6 glass-card" data-id="${cartao.id}">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-credit-card text-primary text-xl mr-3"></i>
                                <h3 class="font-semibold text-gray-800 text-lg">${cartao.apelido}</h3>
                            </div>
                            ${cartao.principal ? '<span class="badge-primary">Principal</span>' : ''}
                        </div>
                        <div class="space-y-2 text-gray-600">
                            <p class="flex items-center">
                                <i class="fas fa-hashtag mr-2 w-4 text-center"></i>
                                ${cartao.numero}
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-user mr-2 w-4 text-center"></i>
                                Titular: ${cartao.titular}
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2 w-4 text-center"></i>
                                Válido até: ${cartao.validade}
                            </p>
                        </div>
                        <div class="flex space-x-3 mt-4">
                            <button class="text-primary hover:text-primary-dark font-medium flex items-center" onclick="editarCartao(${cartao.id})">
                                <i class="fas fa-edit mr-2"></i> Editar
                            </button>
                            <button class="text-danger hover:text-red-800 font-medium flex items-center" onclick="excluirCartao(${cartao.id})">
                                <i class="fas fa-trash mr-2"></i> Excluir
                            </button>
                        </div>
                    </div>
                `;
                lista.innerHTML += cartaoHTML;
            });
        }

        function adicionarCartao() {
            document.getElementById('cartao-id').value = '';
            document.getElementById('cartao-form').reset();
            document.getElementById('titulo-form-cartao').innerHTML = '<i class="fas fa-credit-card mr-3 text-primary"></i>Adicionar Cartão';
            document.getElementById('texto-botao-cartao').textContent = 'Salvar Cartão';
            document.getElementById('form-cartao').classList.remove('hidden');
            document.getElementById('form-cartao').scrollIntoView({ behavior: 'smooth' });
        }

        function editarCartao(id) {
            const cartao = cartoes.find(c => c.id === id);
            if (cartao) {
                document.getElementById('cartao-id').value = cartao.id;
                document.getElementById('cartao-apelido').value = cartao.apelido;
                document.getElementById('cartao-numero').value = cartao.numero.replace(/\*/g, '');
                document.getElementById('cartao-titular').value = cartao.titular;
                document.getElementById('cartao-validade').value = cartao.validade;
                document.getElementById('cartao-cvv').value = '';
                document.getElementById('cartao-principal').checked = cartao.principal;
                
                document.getElementById('titulo-form-cartao').innerHTML = '<i class="fas fa-edit mr-3 text-primary"></i>Editar Cartão';
                document.getElementById('texto-botao-cartao').textContent = 'Atualizar Cartão';
                document.getElementById('form-cartao').classList.remove('hidden');
                document.getElementById('form-cartao').scrollIntoView({ behavior: 'smooth' });
            }
        }

        function salvarCartao(e) {
            e.preventDefault();
            
            const id = document.getElementById('cartao-id').value;
            const formData = new FormData(e.target);
            const isPrincipal = formData.get('principal') === 'on';
            
            // Se marcar como principal, remove principal dos outros
            if (isPrincipal) {
                cartoes.forEach(c => c.principal = false);
            }
            
            // Mascarar número do cartão (apenas últimos 4 dígitos visíveis)
            const numeroCartao = formData.get('numero');
            const numeroMascarado = '**** **** **** ' + numeroCartao.slice(-4);
            
            const cartaoData = {
                id: id ? parseInt(id) : Date.now(),
                apelido: formData.get('apelido'),
                numero: numeroMascarado,
                titular: formData.get('titular'),
                validade: formData.get('validade'),
                principal: isPrincipal
            };
            
            if (id) {
                // Editar cartão existente
                const index = cartoes.findIndex(c => c.id === parseInt(id));
                if (index !== -1) {
                    cartoes[index] = cartaoData;
                }
            } else {
                // Adicionar novo cartão
                cartoes.push(cartaoData);
            }
            
            carregarCartoes();
            cancelarCartao();
            mostrarToast('Cartão salvo com sucesso!', 'success');
        }

        function excluirCartao(id) {
            if (confirm('Tem certeza que deseja excluir este cartão?')) {
                cartoes = cartoes.filter(c => c.id !== id);
                carregarCartoes();
                mostrarToast('Cartão excluído com sucesso!', 'success');
            }
        }

        function cancelarCartao() {
            document.getElementById('form-cartao').classList.add('hidden');
        }

        // ===== FUNÇÕES GERAIS =====
        function mostrarSecao(secaoId) {
            document.querySelectorAll('.secao').forEach(secao => {
                secao.classList.remove('ativa');
            });
            document.getElementById(secaoId).classList.add('ativa');
            document.getElementById(secaoId).scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function resetForm(secaoId) {
            document.querySelectorAll(`#${secaoId} form`).forEach(form => {
                form.reset();
            });
        }

        function mostrarToast(mensagem, tipo = 'success') {
            // Criar elemento toast
            const toast = document.createElement('div');
            toast.className = `fixed top-6 right-6 z-50 px-6 py-4 rounded-xl flex items-center shadow-lg transform transition-all duration-300 ${
                tipo === 'success' ? 'success-message' : 'error-message'
            }`;
            toast.style.transform = 'translateX(100%)';
            
            toast.innerHTML = `
                <i class="fas ${tipo === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} text-2xl mr-3 ${
                    tipo === 'success' ? 'text-green-600' : 'text-red-600'
                }"></i>
                <div>
                    <p class="font-semibold ${tipo === 'success' ? 'text-green-800' : 'text-red-800'}">${mensagem}</p>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Animação de entrada
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);
            
            // Remover após 4 segundos
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 4000);
        }
    </script>
</body>
</html>