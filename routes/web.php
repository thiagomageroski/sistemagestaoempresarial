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
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');
Route::get('/produtos/categoria/{categoria}', [ProdutoController::class, 'porCategoria'])->name('produtos.categoria');
Route::get('/produtos/destaque', [ProdutoController::class, 'destaque'])->name('produtos.destaque');

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
Route::get('/admin/create-user', [AdminController::class, 'createAdminUser'])->name('admin.create.user');


/*
|--------------------------------------------------------------------------
| Área Administrativa (Protegida por middleware admin)
| Todas as rotas aqui requerem que o usuário seja administrador
|--------------------------------------------------------------------------
*/
Route::middleware([AdminAuth::class])->prefix('admin')->group(function () {
    // Página principal redireciona para produtos
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Logout do admin
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Rotas de produtos administrativas (CORRIGIDAS)
    Route::get('/produtos', [AdminController::class, 'produtos'])->name('admin.produtos');
    Route::post('/salvar-produto', [AdminController::class, 'salvarProduto'])->name('admin.salvar-produto');
    Route::delete('/excluir-produto/{id}', [AdminController::class, 'excluirProduto'])->name('admin.excluir-produto');
});

// ROTAS DO PERFIL
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