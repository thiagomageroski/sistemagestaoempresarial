<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Produto;

class AdminController extends Controller
{
    // Mostrar formulário de login do admin
    public function showLoginForm()
    {
        // Se já estiver logado como admin, redirecionar para a página de produtos
        $user = Session::get('user');
        if ($user && $user['role'] === 'admin') {
            return redirect()->route('admin.produtos');
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

        // Verificação em texto puro
        if ($user && $credentials['password'] === $user['password'] && $user['role'] === 'admin') {
            // Login bem-sucedido
            Session::put('user', $user);
            Session::put('auth', true);
            Session::put('last_login', now()->toDateTimeString());

            // Redirecionar direto para a página de produtos
            return redirect()->route('admin.produtos')
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

        // Redirecionar direto para a página de produtos
        return redirect()->route('admin.produtos');
    }

    // Método para mostrar o formulário de cadastro de produtos
    public function produtos()
    {
        return view('pages.admin.admin');
    }

    // Método para salvar o produto
    public function salvarProduto(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required|numeric',
            'imagem' => 'required|image'
        ]);

        $imagemPath = $request->file('imagem')->store('products', 'public');

        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'imagem' => $imagemPath
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado!');
    }

    // Método para excluir produto
    public function excluirProduto($id)
    {
        $produto = Produto::find($id);
        
        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();
        return back()->with('success', 'Produto excluído!');
    }

    // Método auxiliar para obter usuários
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

        // Usuário admin padrão
        $adminUser = [
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => 'admin123',
            'role' => 'admin',
            'created_at' => now()->toDateTimeString()
        ];

        // Salvar no arquivo
        $this->saveUsers([$adminUser]);

        return [$adminUser];
    }

    // Método para salvar usuários
    private function saveUsers($users)
    {
        try {
            Storage::put('users.json', json_encode($users, JSON_PRETTY_PRINT));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    // Método para criar usuário admin (apenas para desenvolvimento)
    public function createAdminUser()
    {
        $users = $this->getUsers();

        // Verificar se já existe um admin
        $adminExists = collect($users)->firstWhere('role', 'admin');

        if (!$adminExists) {
            // Criar usuário admin padrão
            $adminUser = [
                'id' => count($users) + 1,
                'name' => 'Administrador',
                'email' => 'admin@email.com',
                'password' => 'admin123',
                'role' => 'admin',
                'created_at' => now()->toDateTimeString()
            ];

            $users[] = $adminUser;
            $saved = $this->saveUsers($users);

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
}