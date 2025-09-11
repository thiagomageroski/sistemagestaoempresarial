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
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --secondary: #64748b;
            --light: #f8fafc;
            --border: #e2e8f0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
        }
        
        .nav-tab {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .nav-tab::before {
            content: '';
            position: absolute;
            left: -100%;
            bottom: 0;
            width: 100%;
            height: 2px;
            background: var(--primary);
            transition: left 0.3s ease;
        }
        
        .nav-tab.active {
            color: var(--primary);
            background: rgba(59, 130, 246, 0.08);
        }
        
        .nav-tab.active::before {
            left: 0;
        }
        
        .avatar-upload {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .avatar-upload:hover {
            transform: scale(1.05);
        }
        
        .avatar-upload:hover .avatar-overlay {
            opacity: 1;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
        }
        
        .btn-secondary {
            background: white;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }
        
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }
        
        .input-field:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .toggle-checkbox:checked {
            background: var(--primary);
        }
        
        .toggle-checkbox:checked + .toggle-label {
            background: var(--primary);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 1rem;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .section-divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, var(--border) 50%, transparent 100%);
            margin: 2rem 0;
        }
        
        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .floating-label input {
            padding-top: 1.5rem;
        }
        
        .floating-label label {
            position: absolute;
            top: 0.75rem;
            left: 1rem;
            font-size: 0.875rem;
            color: var(--secondary);
            transition: all 0.3s ease;
            pointer-events: none;
        }
        
        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            top: 0.25rem;
            font-size: 0.75rem;
            color: var(--primary);
        }
        
        .secao {
            display: none;
        }
        
        .secao.ativa {
            display: block;
        }
        
        .endereco-item, .cartao-item {
            transition: all 0.3s ease;
        }
        
        .endereco-item:hover, .cartao-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    @include('partials.navbar')
    
    <main class="flex-grow container mx-auto px-4 py-8 mt-16">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Meu Perfil</h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Gerencie suas informações pessoais, preferências e configure sua conta</p>
            </div>
            
            <!-- Mensagens de sucesso/erro -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8 flex items-center">
                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl mb-8 flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar de Navegação -->
                <div class="w-full lg:w-1/4">
                    <div class="glass-card rounded-2xl p-6 mb-6">
                        <div class="flex flex-col items-center mb-6">
                            <div class="avatar-upload relative mb-4">
                                <div class="w-28 h-28 rounded-full bg-blue-100 border-4 border-white shadow-lg overflow-hidden">
                                    <img src="{{ $perfil['avatar'] ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80' }}" 
                                         alt="Avatar" class="w-full h-full object-cover">
                                </div>
                                <div class="avatar-overlay absolute inset-0 bg-blue-800 bg-opacity-80 rounded-full flex items-center justify-center opacity-0 transition-opacity duration-300">
                                    <i class="fas fa-camera text-white text-2xl"></i>
                                </div>
                                <input type="file" id="avatar-upload-input" class="hidden" accept="image/*">
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800 text-center">{{ $user['name'] }}</h2>
                            <p class="text-blue-600 text-sm mt-1">{{ $user['email'] }}</p>
                            <span class="mt-3 bg-blue-100 text-blue-800 text-xs px-4 py-1.5 rounded-full font-medium">
                                {{ $user['role'] === 'admin' ? 'Administrador' : 'Cliente Premium' }}
                            </span>
                        </div>
                        
                        <nav class="space-y-2">
                            <a href="#informacoes" class="nav-tab active flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-700 transition-all duration-300" data-target="informacoes">
                                <i class="fas fa-user-circle mr-3 text-blue-600 text-lg"></i>
                                <span>Informações Pessoais</span>
                            </a>
                            <a href="#seguranca" class="nav-tab flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-700 transition-all duration-300" data-target="seguranca">
                                <i class="fas fa-lock mr-3 text-blue-600 text-lg"></i>
                                <span>Segurança</span>
                            </a>
                            <a href="#preferencias" class="nav-tab flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-700 transition-all duration-300" data-target="preferencias">
                                <i class="fas fa-bell mr-3 text-blue-600 text-lg"></i>
                                <span>Preferências</span>
                            </a>
                            <a href="#enderecos" class="nav-tab flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-700 transition-all duration-300" data-target="enderecos">
                                <i class="fas fa-map-marker-alt mr-3 text-blue-600 text-lg"></i>
                                <span>Endereços</span>
                            </a>
                            <a href="#pagamentos" class="nav-tab flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-700 transition-all duration-300" data-target="pagamentos">
                                <i class="fas fa-credit-card mr-3 text-blue-600 text-lg"></i>
                                <span>Pagamentos</span>
                            </a>
                        </nav>
                    </div>
                    
                    <div class="glass-card rounded-2xl p-6">
                        <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-chart-line mr-2 text-blue-600"></i>
                            Estatísticas da Conta
                        </h3>
                        <div class="space-y-4">
                            <div class="stat-card">
                                <p class="text-sm text-gray-600 mb-1">Pedidos Realizados</p>
                                <p class="text-xl font-bold text-blue-700">{{ $totalPedidos }}</p>
                            </div>
                            <div class="stat-card">
                                <p class="text-sm text-gray-600 mb-1">Membro desde</p>
                                <p class="text-xl font-bold text-blue-700">{{ \Carbon\Carbon::parse($user['created_at'])->format('M Y') }}</p>
                            </div>
                            <div class="stat-card">
                                <p class="text-sm text-gray-600 mb-1">Último acesso</p>
                                <p class="text-xl font-bold text-blue-700">Hoje, {{ date('H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Conteúdo Principal -->
                <div class="w-full lg:w-3/4">
                    <!-- Informações Pessoais -->
                    <div id="informacoes" class="secao ativa glass-card rounded-2xl p-8 mb-8">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-user-circle mr-3 text-blue-600"></i>
                                Informações Pessoais
                            </h2>
                        </div>
                        
                        <form action="{{ route('perfil.update') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="floating-label">
                                    <input type="text" name="nome" value="{{ $perfil['nome'] }}" 
                                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder=" " required>
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="floating-label">
                                    <input type="text" name="sobrenome" value="{{ $perfil['sobrenome'] }}" 
                                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder=" ">
                                    <label for="sobrenome">Sobrenome</label>
                                </div>
                            </div>
                            
                            <div class="floating-label">
                                <input type="email" value="{{ $user['email'] }}" disabled
                                       class="input-field w-full px-4 py-3 rounded-xl bg-gray-50 cursor-not-allowed"
                                       placeholder=" ">
                                <label for="email">E-mail</label>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-info-circle mr-1"></i> O e-mail não pode ser alterado
                                </p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="floating-label">
                                    <input type="tel" name="telefone" value="{{ $perfil['telefone'] }}" 
                                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder=" ">
                                    <label for="telefone">Telefone</label>
                                </div>
                                <div class="floating-label">
                                    <input type="date" name="data_nascimento" value="{{ $perfil['data_nascimento'] }}" 
                                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder=" ">
                                    <label for="data_nascimento">Data de Nascimento</label>
                                </div>
                            </div>
                            
                            <hr class="section-divider">
                            
                            <div class="flex justify-end space-x-4 pt-4">
                                <button type="button" class="btn-secondary px-6 py-3 rounded-xl transition-all duration-300 flex items-center" onclick="resetForm('informacoes')">
                                    <i class="fas fa-times mr-2"></i> Cancelar
                                </button>
                                <button type="submit" class="btn-primary px-6 py-3 rounded-xl text-white flex items-center">
                                    <i class="fas fa-save mr-2"></i> Salvar Alterações
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Alterar Senha -->
                    <div id="seguranca" class="secao glass-card rounded-2xl p-8 mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-8 flex items-center">
                            <i class="fas fa-lock mr-3 text-blue-600"></i>
                            Alterar Senha
                        </h2>
                        
                        <form action="{{ route('perfil.update-password') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="floating-label">
                                    <input type="password" name="senha_atual" 
                                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder=" " required>
                                    <label for="senha_atual">Senha Atual</label>
                                </div>
                                <div class="floating-label">
                                    <input type="password" name="nova_senha" 
                                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder=" " required>
                                    <label for="nova_senha">Nova Senha</label>
                                </div>
                                <div class="floating-label">
                                    <input type="password" name="nova_senha_confirmation" 
                                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder=" " required>
                                    <label for="nova_senha_confirmation">Confirmar Nova Senha</label>
                                </div>
                            </div>
                            
                            <div class="flex justify-end pt-4">
                                <button type="button" class="btn-secondary px-6 py-3 rounded-xl transition-all duration-300 flex items-center mr-4" onclick="resetForm('seguranca')">
                                    <i class="fas fa-times mr-2"></i> Cancelar
                                </button>
                                <button type="submit" class="btn-primary px-6 py-3 rounded-xl text-white flex items-center">
                                    <i class="fas fa-key mr-2"></i> Atualizar Senha
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Preferências de Comunicação -->
                    <div id="preferencias" class="secao glass-card rounded-2xl p-8 mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-8 flex items-center">
                            <i class="fas fa-bell mr-3 text-blue-600"></i>
                            Preferências de Comunicação
                        </h2>
                        
                        <form action="{{ route('perfil.update') }}" method="POST">
                            @csrf
                            <div class="space-y-6">
                                <div class="flex items-center justify-between p-4 rounded-xl hover:bg-gray-50 transition-colors duration-300">
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-800">E-mails Promocionais</h3>
                                        <p class="text-sm text-gray-600 mt-1">Receber ofertas e novidades por e-mail</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="email_promocional" value="1" 
                                               class="sr-only peer" {{ $perfil['preferencias']['email_promocional'] ? 'checked' : '' }}>
                                        <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between p-4 rounded-xl hover:bg-gray-50 transition-colors duration-300">
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-800">Notificações por SMS</h3>
                                        <p class="text-sm text-gray-600 mt-1">Receber alertas importantes por SMS</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="notificacao_sms" value="1" 
                                               class="sr-only peer" {{ $perfil['preferencias']['notificacao_sms'] ? 'checked' : '' }}>
                                        <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center justify-between p-4 rounded-xl hover:bg-gray-50 transition-colors duration-300">
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-800">Notificações por Push</h3>
                                        <p class="text-sm text-gray-600 mt-1">Receber notificações no navegador</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="notificacao_push" value="1" 
                                               class="sr-only peer" {{ $perfil['preferencias']['notificacao_push'] ? 'checked' : '' }}>
                                        <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                            </div>
                            
                            <hr class="section-divider">
                            
                            <div class="flex justify-end pt-4">
                                <button type="button" class="btn-secondary px-6 py-3 rounded-xl transition-all duration-300 flex items-center mr-4" onclick="resetForm('preferencias')">
                                    <i class="fas fa-times mr-2"></i> Cancelar
                                </button>
                                <button type="submit" class="btn-primary px-6 py-3 rounded-xl text-white flex items-center">
                                    <i class="fas fa-sync-alt mr-2"></i> Salvar Preferências
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Endereços -->
                    <div id="enderecos" class="secao glass-card rounded-2xl p-8 mb-8">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-blue-600"></i>
                                Meus Endereços
                            </h2>
                            <button class="btn-primary px-4 py-2 rounded-xl text-white flex items-center text-sm" onclick="adicionarEndereco()">
                                <i class="fas fa-plus mr-2"></i> Novo Endereço
                            </button>
                        </div>
                        
                        <div class="space-y-4" id="lista-enderecos">
                            <!-- Endereços serão carregados aqui -->
                        </div>
                        
                        <!-- Formulário de Endereço -->
                        <div id="form-endereco" class="hidden mt-6 p-6 border border-gray-200 rounded-xl glass-card">
                            <h3 class="font-semibold text-gray-800 mb-4" id="titulo-form-endereco">Adicionar Endereço</h3>
                            <form id="endereco-form" class="space-y-4">
                                <input type="hidden" id="endereco-id" name="id" value="">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="floating-label">
                                        <input type="text" id="endereco-cep" name="cep" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="endereco-cep">CEP</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="endereco-apelido" name="apelido" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="endereco-apelido">Apelido (Ex: Casa, Trabalho)</label>
                                    </div>
                                </div>
                                
                                <div class="floating-label">
                                    <input type="text" id="endereco-logradouro" name="logradouro" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                    <label for="endereco-logradouro">Endereço</label>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="floating-label">
                                        <input type="text" id="endereco-numero" name="numero" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="endereco-numero">Número</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="endereco-complemento" name="complemento" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" ">
                                        <label for="endereco-complemento">Complemento</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="endereco-bairro" name="bairro" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="endereco-bairro">Bairro</label>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="floating-label">
                                        <input type="text" id="endereco-cidade" name="cidade" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="endereco-cidade">Cidade</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="endereco-estado" name="estado" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="endereco-estado">Estado</label>
                                    </div>
                                </div>
                                
                                <div class="flex items-center mb-4">
                                    <input type="checkbox" id="endereco-principal" name="principal" class="mr-2">
                                    <label for="endereco-principal" class="text-sm text-gray-700">Definir como endereço principal</label>
                                </div>
                                
                                <div class="flex justify-end space-x-3">
                                    <button type="button" class="btn-secondary px-4 py-2 rounded-xl text-sm" onclick="cancelarEndereco()">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn-primary px-4 py-2 rounded-xl text-white text-sm">
                                        <span id="texto-botao-endereco">Salvar Endereço</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Pagamentos -->
                    <div id="pagamentos" class="secao glass-card rounded-2xl p-8">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-credit-card mr-3 text-blue-600"></i>
                                Meus Cartões
                            </h2>
                            <button class="btn-primary px-4 py-2 rounded-xl text-white flex items-center text-sm" onclick="adicionarCartao()">
                                <i class="fas fa-plus mr-2"></i> Novo Cartão
                            </button>
                        </div>
                        
                        <div class="space-y-4" id="lista-cartoes">
                            <!-- Cartões serão carregados aqui -->
                        </div>
                        
                        <!-- Formulário de Cartão -->
                        <div id="form-cartao" class="hidden mt-6 p-6 border border-gray-200 rounded-xl glass-card">
                            <h3 class="font-semibold text-gray-800 mb-4" id="titulo-form-cartao">Adicionar Cartão</h3>
                            <form id="cartao-form" class="space-y-4">
                                <input type="hidden" id="cartao-id" name="id" value="">
                                
                                <div class="floating-label">
                                    <input type="text" id="cartao-numero" name="numero" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                    <label for="cartao-numero">Número do Cartão</label>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="floating-label">
                                        <input type="text" id="cartao-titular" name="titular" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="cartao-titular">Nome do Titular</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="cartao-validade" name="validade" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="cartao-validade">Validade (MM/AA)</label>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="floating-label">
                                        <input type="text" id="cartao-cvv" name="cvv" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="cartao-cvv">CVV</label>
                                    </div>
                                    <div class="floating-label">
                                        <input type="text" id="cartao-apelido" name="apelido" class="input-field w-full px-4 py-2 rounded-xl" placeholder=" " required>
                                        <label for="cartao-apelido">Apelido (Ex: Cartão Principal)</label>
                                    </div>
                                </div>
                                
                                <div class="flex items-center mb-4">
                                    <input type="checkbox" id="cartao-principal" name="principal" class="mr-2">
                                    <label for="cartao-principal" class="text-sm text-gray-700">Definir como cartão principal</label>
                                </div>
                                
                                <div class="flex justify-end space-x-3">
                                    <button type="button" class="btn-secondary px-4 py-2 rounded-xl text-sm" onclick="cancelarCartao()">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn-primary px-4 py-2 rounded-xl text-white text-sm">
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
            const avatarUpload = document.querySelector('.avatar-upload');
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
                            alert('Avatar atualizado com sucesso!');
                        } else {
                            alert('Erro ao atualizar avatar: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Erro ao atualizar avatar');
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
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-map-marker-alt text-4xl mb-4"></i>
                        <p>Nenhum endereço cadastrado</p>
                    </div>
                `;
                return;
            }
            
            enderecos.forEach(endereco => {
                const enderecoHTML = `
                    <div class="endereco-item p-4 border border-gray-200 rounded-xl glass-card" data-id="${endereco.id}">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-medium text-gray-800">${endereco.apelido}</h3>
                            ${endereco.principal ? '<span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Principal</span>' : ''}
                        </div>
                        <p class="text-gray-600">${endereco.logradouro}${endereco.complemento ? ', ' + endereco.complemento : ''}</p>
                        <p class="text-gray-600">${endereco.bairro}, ${endereco.cidade} - ${endereco.estado}</p>
                        <p class="text-gray-600">CEP: ${endereco.cep}</p>
                        <div class="flex space-x-2 mt-3">
                            <button class="text-blue-600 hover:text-blue-800 text-sm" onclick="editarEndereco(${endereco.id})">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </button>
                            <button class="text-red-600 hover:text-red-800 text-sm" onclick="excluirEndereco(${endereco.id})">
                                <i class="fas fa-trash mr-1"></i> Excluir
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
            document.getElementById('titulo-form-endereco').textContent = 'Adicionar Endereço';
            document.getElementById('texto-botao-endereco').textContent = 'Salvar Endereço';
            document.getElementById('form-endereco').classList.remove('hidden');
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
                
                document.getElementById('titulo-form-endereco').textContent = 'Editar Endereço';
                document.getElementById('texto-botao-endereco').textContent = 'Atualizar Endereço';
                document.getElementById('form-endereco').classList.remove('hidden');
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
            alert('Endereço salvo com sucesso!');
        }

        function excluirEndereco(id) {
            if (confirm('Tem certeza que deseja excluir este endereço?')) {
                enderecos = enderecos.filter(e => e.id !== id);
                carregarEnderecos();
                alert('Endereço excluído com sucesso!');
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
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-credit-card text-4xl mb-4"></i>
                        <p>Nenhum cartão cadastrado</p>
                    </div>
                `;
                return;
            }
            
            cartoes.forEach(cartao => {
                const cartaoHTML = `
                    <div class="cartao-item p-4 border border-gray-200 rounded-xl glass-card" data-id="${cartao.id}">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-medium text-gray-800">${cartao.apelido}</h3>
                            ${cartao.principal ? '<span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Principal</span>' : ''}
                        </div>
                        <p class="text-gray-600">${cartao.numero}</p>
                        <p class="text-gray-600">Titular: ${cartao.titular}</p>
                        <p class="text-gray-600">Válido até: ${cartao.validade}</p>
                        <div class="flex space-x-2 mt-3">
                            <button class="text-blue-600 hover:text-blue-800 text-sm" onclick="editarCartao(${cartao.id})">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </button>
                            <button class="text-red-600 hover:text-red-800 text-sm" onclick="excluirCartao(${cartao.id})">
                                <i class="fas fa-trash mr-1"></i> Excluir
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
            document.getElementById('titulo-form-cartao').textContent = 'Adicionar Cartão';
            document.getElementById('texto-botao-cartao').textContent = 'Salvar Cartão';
            document.getElementById('form-cartao').classList.remove('hidden');
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
                
                document.getElementById('titulo-form-cartao').textContent = 'Editar Cartão';
                document.getElementById('texto-botao-cartao').textContent = 'Atualizar Cartão';
                document.getElementById('form-cartao').classList.remove('hidden');
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
            alert('Cartão salvo com sucesso!');
        }

        function excluirCartao(id) {
            if (confirm('Tem certeza que deseja excluir este cartão?')) {
                cartoes = cartoes.filter(c => c.id !== id);
                carregarCartoes();
                alert('Cartão excluído com sucesso!');
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
        }

        function resetForm(secaoId) {
            document.querySelectorAll(`#${secaoId} form`).forEach(form => {
                form.reset();
            });
        }
    </script>
</body>
</html>