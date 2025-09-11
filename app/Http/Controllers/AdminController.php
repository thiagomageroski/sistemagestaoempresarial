<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Mostrar formulário de login do admin
    public function showLoginForm()
    {
        // Se já estiver logado como admin, redirecionar para o dashboard
        $user = Session::get('user');
        if ($user && $user['role'] === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Se estiver logado como usuário normal, fazer logout primeiro
        if ($user && $user['role'] !== 'admin') {
            Session::forget('user');
            Session::forget('auth');
            Session::forget('last_login');
            Session::forget('carrinho');
            Session::forget('carrinho_count');
        }

        return view('pages.admin.login');
    }

    // Processar login do admin
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        $users = $this->getUsers();

        // Buscar usuário pelo email
        $user = collect($users)->firstWhere('email', $credentials['email']);

        // Verificação em texto puro (conforme seu AuthController)
        if ($user && $credentials['password'] === $user['password'] && $user['role'] === 'admin') {
            // Login bem-sucedido
            Session::put('user', $user);
            Session::put('auth', true);
            Session::put('last_login', now()->toDateTimeString());

            return redirect()->route('admin.dashboard')
                ->with('success', 'Login administrativo realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas ou acesso não autorizado',
        ])->withInput($request->only('email'));
    }

    // Logout do admin
    public function logout(Request $request)
    {
        Session::forget('user');
        Session::forget('auth');
        Session::forget('last_login');

        return redirect()->route('admin.login')
            ->with('success', 'Logout realizado com sucesso!');
    }

    public function index()
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('admin.login')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem acessar esta área.');
        }

        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('admin.login')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem acessar esta área.');
        }

        return view('pages.admin.dashboard');
    }

    public function show($id)
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('admin.login')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem acessar esta área.');
        }

        // Dados de exemplo para demonstração
        $registro = [
            'id' => $id,
            'titulo' => 'Detalhes do Item #' . $id,
            'descricao' => 'Informações detalhadas sobre o item selecionado',
            'criado_em' => now()->subDays(rand(1, 30))->format('d/m/Y H:i'),
            'status' => 'Ativo',
            'detalhes' => [
                'Nome' => 'Item ' . $id,
                'Categoria' => 'Categoria Exemplo',
                'Descrição' => 'Esta é uma descrição detalhada do item #' . $id,
                'Data de Criação' => now()->subDays(rand(1, 365))->format('d/m/Y'),
                'Última Atualização' => now()->subDays(rand(1, 30))->format('d/m/Y H:i'),
            ]
        ];

        return view('pages.admin.show', compact('registro'));
    }

    // Métodos para API (usados nos gráficos do dashboard)
    public function metricas()
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        // Dados simulados para as métricas
        return response()->json([
            'vendas_hoje' => rand(100, 200),
            'clientes_cadastrados' => rand(2000, 3000),
            'produtos_estoque' => rand(100, 150),
            'receita_dia' => rand(10000, 15000),
            'vendas_semana' => [
                'seg' => rand(1000, 3000),
                'ter' => rand(1000, 3000),
                'qua' => rand(1000, 3000),
                'qui' => rand(1000, 3000),
                'sex' => rand(1000, 3000),
                'sab' => rand(1000, 3000),
                'dom' => rand(1000, 3000),
            ],
            'categorias' => [
                'eletronicos' => rand(20, 40),
                'roupas' => rand(15, 35),
                'casa' => rand(10, 30),
                'esportes' => rand(5, 25),
            ]
        ]);
    }

    public function vendasRecentes()
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        // Dados simulados de vendas recentes
        $vendas = [];
        $statuses = ['pendente', 'processando', 'enviado', 'entregue', 'cancelado'];
        $nomes = ['João Silva', 'Maria Santos', 'Pedro Oliveira', 'Ana Costa', 'Carlos Souza'];

        for ($i = 0; $i < 10; $i++) {
            $vendas[] = [
                'id' => '#' . (12345 + $i),
                'cliente' => $nomes[array_rand($nomes)],
                'data' => now()->subDays(rand(0, 7))->format('d/m/Y'),
                'valor' => 'R$ ' . number_format(rand(100, 2000), 2, ',', '.'),
                'status' => $statuses[array_rand($statuses)]
            ];
        }

        return response()->json($vendas);
    }

    // Método auxiliar para obter usuários (similar ao AuthController)
    private function getUsers()
    {
        try {
            if (Storage::exists('users.json')) {
                $content = Storage::get('users.json');
                $users = json_decode($content, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($users)) {
                    return $users;
                }
            }
        } catch (\Exception $e) {
            // Se houver erro, retorna array vazio
        }

        // Usuário admin padrão - SENHA CORRIGIDA para 'admin123'
        $adminUser = [
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => 'admin123', // ← CORRIGIDO!
            'role' => 'admin',
            'created_at' => now()->toDateTimeString()
        ];

        // Salvar no arquivo
        $this->saveUsers([$adminUser]);

        return [$adminUser];
    }

    // Novos métodos para pedidos
    public function pedidos()
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('admin.login')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem acessar esta área.');
        }

        return view('pages.admin.dashboard');
    }

    public function pedidoShow($id)
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('admin.login')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem acessar esta área.');
        }

        // Lógica para mostrar detalhes do pedido
        return view('pages.admin.pedidos.show', compact('id'));
    }

    public function atualizarStatusPedido(Request $request, $id)
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        // Lógica para atualizar status do pedido
        return response()->json(['success' => true, 'message' => 'Status atualizado com sucesso']);
    }

    // Métodos para relatórios
    public function relatorios()
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('admin.login')
                ->with('error', 'Acesso não autorizado. Apenas administradores podem acessar esta área.');
        }

        return view('pages.admin.dashboard');
    }

    public function relatorioVendas()
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        // Lógica para relatório de vendas
        return response()->json(['data' => []]);
    }

    public function relatorioProdutos()
    {
        // Verificar se o usuário é administrador
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        // Lógica para relatório de produtos
        return response()->json(['data' => []]);
    }

    // Método para criar usuário admin (apenas para desenvolvimento)
    // Método para criar usuário admin (apenas para desenvolvimento)
    public function createAdminUser()
    {
        $users = $this->getUsers();

        // Verificar se já existe um admin
        $adminExists = collect($users)->firstWhere('role', 'admin');

        if (!$adminExists) {
            // Criar usuário admin padrão COM SENHA CORRETA
            $adminUser = [
                'id' => count($users) + 1,
                'name' => 'Administrador',
                'email' => 'admin@email.com',
                'password' => 'admin123', // ← SENHA CORRETA
                'role' => 'admin',
                'created_at' => now()->toDateTimeString()
            ];

            $users[] = $adminUser;
            $saved = $this->saveUsers($users); // ← Use saveUsers() em vez de método inexistente

            if ($saved) {
                return response()->json([
                    'success' => true,
                    'message' => 'Usuário admin criado com sucesso!',
                    'admin' => [
                        'email' => 'admin@email.com',
                        'password' => 'admin123'
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao salvar usuário admin.'
                ], 500);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Usuário admin já existe'
        ]);
    }

    // Método para salvar usuários (similar ao AuthController)
    private function saveUsers($users)
    {
        try {
            Storage::put('users.json', json_encode($users, JSON_PRETTY_PRINT));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}