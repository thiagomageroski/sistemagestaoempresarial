<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    // Arquivo para persistência dos dados de perfil
    private $perfisFile = 'perfis.json';
    
    /**
     * Retorna os dados do perfil do usuário logado
     */
    private function getPerfilUsuario()
    {
        $user = Session::get('user');
        if (!$user) {
            return null;
        }

        try {
            if (Storage::exists($this->perfisFile)) {
                $content = Storage::get($this->perfisFile);
                $perfis = json_decode($content, true);
                
                if (json_last_error() === JSON_ERROR_NONE && is_array($perfis)) {
                    // Buscar perfil pelo ID do usuário
                    return collect($perfis)->firstWhere('user_id', $user['id']);
                }
            }
        } catch (\Exception $e) {
            // Log error if needed
        }
        
        // Se não encontrar, retorna um perfil vazio
        return [
            'user_id' => $user['id'],
            'nome' => $user['name'] ?? '',
            'sobrenome' => '',
            'telefone' => '',
            'data_nascimento' => '',
            'avatar' => '',
            'preferencias' => [
                'email_promocional' => true,
                'notificacao_sms' => false,
                'notificacao_push' => true
            ]
        ];
    }
    
    /**
     * Salva os dados do perfil
     */
    private function salvarPerfil($dadosPerfil)
    {
        try {
            $perfis = [];
            
            if (Storage::exists($this->perfisFile)) {
                $content = Storage::get($this->perfisFile);
                $perfis = json_decode($content, true);
                
                if (json_last_error() !== JSON_ERROR_NONE || !is_array($perfis)) {
                    $perfis = [];
                }
            }
            
            // Encontrar índice do perfil existente
            $index = null;
            foreach ($perfis as $i => $perfil) {
                if (isset($perfil['user_id']) && $perfil['user_id'] === $dadosPerfil['user_id']) {
                    $index = $i;
                    break;
                }
            }
            
            // Atualizar ou adicionar perfil
            if ($index !== null) {
                $perfis[$index] = $dadosPerfil;
            } else {
                $perfis[] = $dadosPerfil;
            }
            
            Storage::put($this->perfisFile, json_encode($perfis, JSON_PRETTY_PRINT));
            return true;
            
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Exibe a página de perfil do usuário
     */
    public function index()
    {
        if (!Session::get('user')) {
            return redirect()->route('login')
                ->with('warning', 'Faça login para acessar seu perfil.');
        }
        
        $user = Session::get('user');
        $perfil = $this->getPerfilUsuario();
        
        // Calcular número real de pedidos usando a mesma lógica do MinhasComprasController
        $todosPedidos = $this->carregarTodosPedidos();
        $totalPedidos = 0;
        
        foreach ($todosPedidos as $pedido) {
            if (is_array($pedido) && 
                isset($pedido['cliente']['email']) && 
                $pedido['cliente']['email'] === $user['email']) {
                $totalPedidos++;
            }
        }
        
        return view('pages.perfil', compact('user', 'perfil', 'totalPedidos'));
    }
    
    /**
     * Carrega TODOS os pedidos de forma consistente (sessão + arquivo)
     */
    private function carregarTodosPedidos()
    {
        $pedidosSessao = Session::get('pedidos', []);
        $pedidosArquivo = $this->carregarPedidosArquivo();
        
        // Garantir que ambos sejam arrays
        if (!is_array($pedidosSessao)) $pedidosSessao = [];
        if (!is_array($pedidosArquivo)) $pedidosArquivo = [];
        
        // Combinar pedidos, priorizando a sessão em caso de duplicatas
        return array_merge($pedidosArquivo, $pedidosSessao);
    }
    
    /**
     * Carrega pedidos do arquivo JSON
     */
    private function carregarPedidosArquivo()
    {
        try {
            $pedidosFile = 'pedidos.json';
            
            if (!Storage::exists($pedidosFile)) {
                return [];
            }

            $content = Storage::get($pedidosFile);
            
            if (empty(trim($content))) {
                return [];
            }

            $pedidos = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE || !is_array($pedidos)) {
                return [];
            }

            return $pedidos;

        } catch (\Exception $e) {
            return [];
        }
    }
    
    /**
     * Atualiza o perfil do usuário
     */
    public function update(Request $request)
    {
        if (!Session::get('user')) {
            return redirect()->route('login')
                ->with('error', 'Sessão expirada. Faça login novamente.');
        }
        
        $user = Session::get('user');
        
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'sobrenome' => 'nullable|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'avatar' => 'nullable|string',
            'email_promocional' => 'nullable|boolean',
            'notificacao_sms' => 'nullable|boolean',
            'notificacao_push' => 'nullable|boolean'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor, corrija os erros no formulário.');
        }
        
        // Preparar dados do perfil
        $perfilData = [
            'user_id' => $user['id'],
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'avatar' => $request->avatar,
            'preferencias' => [
                'email_promocional' => (bool) $request->email_promocional,
                'notificacao_sms' => (bool) $request->notificacao_sms,
                'notificacao_push' => (bool) $request->notificacao_push
            ],
            'atualizado_em' => now()->toDateTimeString()
        ];
        
        // Salvar perfil
        $salvo = $this->salvarPerfil($perfilData);
        
        if (!$salvo) {
            return redirect()->back()
                ->with('error', 'Erro ao salvar perfil. Tente novamente.');
        }
        
        // Atualizar também o nome do usuário na sessão se foi alterado
        if ($user['name'] !== $request->nome) {
            $user['name'] = $request->nome;
            Session::put('user', $user);
        }
        
        return redirect()->route('perfil')
            ->with('success', 'Perfil atualizado com sucesso!');
    }
    
    /**
     * Atualiza a senha do usuário
     */
    public function updatePassword(Request $request)
    {
        if (!Session::get('user')) {
            return redirect()->route('login')
                ->with('error', 'Sessão expirada. Faça login novamente.');
        }
        
        $user = Session::get('user');
        
        // Validação
        $validator = Validator::make($request->all(), [
            'senha_atual' => 'required|string|min:6',
            'nova_senha' => 'required|string|min:6|confirmed'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor, corrija os erros no formulário.');
        }
        
        // Buscar usuário para verificar a senha atual
        $users = $this->getUsersFromAuth();
        
        // Encontrar usuário
        $userData = collect($users)->firstWhere('id', $user['id']);
        
        if (!$userData) {
            return redirect()->back()
                ->with('error', 'Usuário não encontrado.');
        }
        
        // Verificar senha atual (em texto plano conforme seu AuthController)
        if ($request->senha_atual !== $userData['password']) {
            return redirect()->back()
                ->with('error', 'Senha atual incorreta.');
        }
        
        // Atualizar senha no arquivo de usuários
        $updated = $this->atualizarSenhaUsuario($user['id'], $request->nova_senha);
        
        if (!$updated) {
            return redirect()->back()
                ->with('error', 'Erro ao atualizar senha. Tente novamente.');
        }
        
        return redirect()->route('perfil')
            ->with('success', 'Senha atualizada com sucesso!');
    }
    
    /**
     * Obtém usuários do AuthController (método similar)
     */
    private function getUsersFromAuth()
    {
        try {
            if (Storage::exists('users.json')) {
                $content = Storage::get('users.json');
                $users = json_decode($content, true);
                
                if (json_last_error() === JSON_ERROR_NONE) {
                    return $users;
                }
            }
        } catch (\Exception $e) {
            // Se houver erro, retorna array vazio
        }
        
        // Usuários padrão se o arquivo não existir ou estiver corrompido
        return [
            [
                'id' => 1,
                'name' => 'Administrador',
                'email' => 'admin@email.com',
                'password' => 'password',
                'role' => 'admin',
                'created_at' => '2024-01-01 00:00:00'
            ]
        ];
    }
    
    /**
     * Atualiza a senha do usuário no arquivo
     */
    private function atualizarSenhaUsuario($userId, $novaSenha)
    {
        try {
            $users = $this->getUsersFromAuth();
            
            // Encontrar e atualizar usuário
            foreach ($users as &$user) {
                if ($user['id'] == $userId) {
                    $user['password'] = $novaSenha;
                    break;
                }
            }
            
            // Salvar usuários atualizados
            Storage::put('users.json', json_encode($users, JSON_PRETTY_PRINT));
            return true;
            
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Faz upload de uma imagem de avatar (simulado)
     */
    public function uploadAvatar(Request $request)
    {
        if (!Session::get('user')) {
            return response()->json([
                'success' => false,
                'message' => 'Não autenticado'
            ], 401);
        }
        
        // Em um sistema real, aqui processaríamos o upload do arquivo
        // Por simplicidade, vamos retornar uma URL de avatar fake
        
        $avatarUrl = "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80";
        
        return response()->json([
            'success' => true,
            'avatar_url' => $avatarUrl
        ]);
    }
}