<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="admin-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2>Painel Admin</h2>
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('admin.produtos') }}"
                    class="menu-item {{ Request::is('admin/produtos') || Request::is('admin') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Cadastrar Produtos</span>
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

        <div class="main-content">
            <header class="content-header">
                <div class="header-left">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1>Cadastro de Produtos</h1>
                </div>
            </header>

            <div class="content">
                <div class="container mx-auto px-4 py-8">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Novo Produto</h2>
                        
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.salvar-produto') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <div>
                                <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome do Produto</label>
                                <input type="text" 
                                       id="nome" 
                                       name="nome" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('nome')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                                <textarea id="descricao" 
                                          name="descricao" 
                                          rows="4"
                                          required
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                @error('descricao')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="preco" class="block text-sm font-medium text-gray-700 mb-2">Preço (R$)</label>
                                <input type="number" 
                                       id="preco" 
                                       name="preco" 
                                       step="0.01"
                                       min="0"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('preco')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="imagem" class="block text-sm font-medium text-gray-700 mb-2">Imagem do Produto</label>
                                <input type="file" 
                                       id="imagem" 
                                       name="imagem" 
                                       accept="image/*"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('imagem')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">Formatos aceitos: JPEG, PNG, JPG, GIF. Tamanho máximo: 2MB</p>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-200 font-medium">
                                    Cadastrar Produto
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Produtos Cadastrados</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagem</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        use App\Models\Produto;
                                        $produtos = Produto::orderBy('created_at', 'desc')->get();
                                    @endphp
                                    
                                    @forelse($produtos as $produto)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <img src="{{ asset('storage/' . $produto->imagem) }}" 
                                                     alt="{{ $produto->nome }}" 
                                                     class="h-12 w-12 object-cover rounded">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $produto->nome }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produto->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form action="{{ route('admin.excluir-produto', $produto->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900"
                                                            onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                                        <i class="fas fa-trash"></i> Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                                Nenhum produto cadastrado ainda.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #1f2937;
            color: white;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #374151;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .sidebar-menu {
            padding: 10px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s;
        }

        .menu-item:hover {
            background: #374151;
            color: white;
        }

        .menu-item.active {
            background: #3b82f6;
            color: white;
        }

        .menu-item i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .content-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #6b7280;
        }

        .content {
            flex: 1;
            padding: 24px;
            background: #f3f4f6;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                z-index: 1000;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>