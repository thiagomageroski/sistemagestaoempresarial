<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Middleware\CustomAuth;
use App\Http\Middleware\VerificarCarrinho;
use App\Http\Middleware\AdminAuth;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');
Route::get('/politicas', function () {
    return view('pages.politicas');
})->name('politicas');
Route::get('/configuracoes', function () {
    return view('pages.configuracoes');
})->name('configuracoes');

// Rotas de autenticação (acessíveis apenas para não autenticados)
Route::middleware([\App\Http\Middleware\CheckAuth::class . ':guest'])->group(function () {
    Route::get('/cadastro', [HomeController::class, 'cadastro'])->name('cadastro');
    Route::get('/login', [HomeController::class, 'login'])->name('login');
});

// Rotas de autenticação (POST) - acessíveis a todos
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register');

// Rota de logout (acessível para todos os usuários autenticados)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ROTAS PÚBLICAS DO ADMIN (LOGIN)
// Estas rotas devem ficar FORA de qualquer middleware de autenticação
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// Rotas de produtos (públicas)
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/categoria/{categoria}', [ProdutoController::class, 'porCategoria'])->name('produtos.categoria');
Route::get('/produtos/destaque', [ProdutoController::class, 'destaque'])->name('produtos.destaque');

// Rota de detalhes do produto (PROTEGIDA - requer autenticação)
Route::middleware([CustomAuth::class])->group(function () {
    Route::get('/produtos/{slug}', [ProdutoController::class, 'show'])->name('produtos.show');
});

// Rotas do Carrinho (protegidas - requerem autenticação)
Route::middleware([CustomAuth::class])->group(function () {
    Route::prefix('carrinho')->group(function () {
        Route::get('/', [CarrinhoController::class, 'index'])->name('carrinho.index');
        Route::post('/adicionar', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
        Route::delete('/remover/{produtoId}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
        Route::put('/atualizar/{produtoId}', [CarrinhoController::class, 'atualizar'])->name('carrinho.atualizar');
        Route::post('/limpar', [CarrinhoController::class, 'limpar'])->name('carrinho.limpar');
        Route::get('/quantidade', [CarrinhoController::class, 'quantidade'])->name('carrinho.quantidade');
        Route::get('/verificar-estoque', [CarrinhoController::class, 'verificarEstoque'])->name('carrinho.verificar.estoque');
    });
});

/*
|--------------------------------------------------------------------------
| Rotas do Checkout (Protegidas - requerem autenticação E produtos no carrinho)
|--------------------------------------------------------------------------
*/
Route::middleware([CustomAuth::class, VerificarCarrinho::class])->group(function () {
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/processar', [CheckoutController::class, 'processarPedido'])->name('checkout.processar');
        Route::get('/confirmacao/{id}', [CheckoutController::class, 'confirmacao'])->name('checkout.confirmacao');
        Route::post('/atualizar-status/{id}', [CheckoutController::class, 'atualizarStatusPagamento'])->name('checkout.atualizar-status');
        Route::post('/aplicar-cupom', [CheckoutController::class, 'aplicarCupom'])->name('checkout.aplicar-cupom');
        Route::post('/remover-cupom', [CheckoutController::class, 'removerCupom'])->name('checkout.remover-cupom');
        Route::post('/calcular-frete', [CheckoutController::class, 'calcularFrete'])->name('checkout.calcular-frete');
    });
});

// Rotas para Minhas Compras (protegidas - requerem autenticação)
Route::middleware([CustomAuth::class])->group(function () {
    Route::get('/minhascompras', [CheckoutController::class, 'meusPedidos'])->name('minhas.compras');
    Route::get('/minhascompras/{id}', [CheckoutController::class, 'detalhesPedido'])->name('detalhes.compra');
    Route::post('/minhascompras/filtrar', [CheckoutController::class, 'filtrar'])->name('filtrar.compras');
});

// Rota para página de sucesso na compra (PROTEGIDA - requer autenticação E pedido finalizado)
Route::middleware([CustomAuth::class, \App\Http\Middleware\VerificarPedidoFinalizado::class])->group(function () {
    Route::get('/sucesso', function () {
        $user = Session::get('user');
        $pedidos = Session::get('pedidos', []);
        $ultimoPedido = end($pedidos);

        return view('pages.produtos.sucesso', compact('user', 'ultimoPedido'));
    })->name('sucesso');
});

// Rotas para desenvolvimento (podem ser removidas em produção)
Route::get('/admin/users', [AuthController::class, 'viewUsers'])->name('admin.users');
Route::get('/admin/clear-users', [AuthController::class, 'clearUsers'])->name('admin.clear.users');


/*
|--------------------------------------------------------------------------
| Área Administrativa (Protegida por middleware admin)
| Todas as rotas aqui requerem que o usuário seja administrador
|--------------------------------------------------------------------------
*/
Route::middleware([AdminAuth::class])->prefix('admin')->group(function () {
    // Dashboard e páginas principais
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    
    // Logout do admin (deve estar dentro do middleware para acessar a sessão)
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // API routes para dados do dashboard
    Route::get('/api/metricas', [AdminController::class, 'metricas'])->name('admin.api.metricas');
    Route::get('/api/vendas-recentes', [AdminController::class, 'vendasRecentes'])->name('admin.api.vendas.recentes');

    // Rotas de clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('admin.clientes.index');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('admin.clientes.show');
    Route::get('/clientes/criar', [ClienteController::class, 'create'])->name('admin.clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('admin.clientes.store');
    Route::get('/clientes/{id}/editar', [ClienteController::class, 'edit'])->name('admin.clientes.edit');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('admin.clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('admin.clientes.destroy');

    // Rotas de produtos administrativas
    Route::get('/produtos', [ProdutoController::class, 'adminIndex'])->name('admin.produtos.index');
    Route::get('/produtos/criar', [ProdutoController::class, 'create'])->name('admin.produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('admin.produtos.store');
    Route::get('/produtos/{id}/editar', [ProdutoController::class, 'edit'])->name('admin.produtos.edit');
    Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('admin.produtos.update');
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('admin.produtos.destroy');
    
    // Rotas de pedidos
    Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos.index');
    Route::get('/pedidos/{id}', [AdminController::class, 'pedidoShow'])->name('admin.pedidos.show');
    Route::put('/pedidos/{id}/status', [AdminController::class, 'atualizarStatusPedido'])->name('admin.pedidos.status');
    
    // Rotas de relatórios
    Route::get('/relatorios', [AdminController::class, 'relatorios'])->name('admin.relatorios');
    Route::get('/relatorios/vendas', [AdminController::class, 'relatorioVendas'])->name('admin.relatorios.vendas');
    Route::get('/relatorios/produtos', [AdminController::class, 'relatorioProdutos'])->name('admin.relatorios.produtos');
});

// ROTAS DO PERFIL - CORRIGIDAS (agora agrupadas corretamente)
Route::middleware([CustomAuth::class])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');
    Route::post('/perfil/update-password', [PerfilController::class, 'updatePassword'])->name('perfil.update-password');
    Route::post('/perfil/upload-avatar', [PerfilController::class, 'uploadAvatar'])->name('perfil.upload-avatar');
});

// Rota para alternar o tema
Route::post('/toggle-theme', function () {
    $theme = session()->get('theme', 'light');
    $newTheme = $theme === 'light' ? 'dark' : 'light';
    session(['theme' => $newTheme]);
    return response()->json(['theme' => $newTheme]);
})->name('toggle-theme');

/*
|--------------------------------------------------------------------------
| Rotas de Health Check e Status
|--------------------------------------------------------------------------
*/
Route::get('/health', function () {
    return response()->json(['status' => 'OK', 'timestamp' => now()]);
});

Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'version' => '1.0.0',
        'environment' => app()->environment()
    ]);
});

/*
|--------------------------------------------------------------------------
| Rota Fallback - PARA PÁGINAS NÃO ENCONTRADAS (DEVE SER A ÚLTIMA ROTA)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('pages.naoexiste', [], 404);
});