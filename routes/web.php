<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Middleware\CustomAuth;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');

// Rotas de autenticação (acessíveis apenas para não autenticados)
Route::middleware(['guest'])->group(function () {
    Route::get('/cadastro', [HomeController::class, 'cadastro'])->name('cadastro');
    Route::get('/login', [HomeController::class, 'login'])->name('login');
});

// Rotas de autenticação (POST) - acessíveis a todos
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register');

// Rotas de produtos (públicas)
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/{slug}', [ProdutoController::class, 'show'])->name('produtos.show');
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
    });
});

// Rotas para desenvolvimento (podem ser removidas em produção)
Route::get('/admin/users', [AuthController::class, 'viewUsers'])->name('admin.users');
Route::get('/admin/clear-users', [AuthController::class, 'clearUsers'])->name('admin.clear.users');

// Rota de login administrativo
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');

/*
|--------------------------------------------------------------------------
| Área Administrativa (Protegida por middleware custom.auth)
|--------------------------------------------------------------------------
*/
Route::middleware([CustomAuth::class])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    
    // Rotas de clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('admin.clientes.index');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('admin.clientes.show');
    
    // Rotas de produtos administrativas
    Route::get('/produtos', [ProdutoController::class, 'adminIndex'])->name('admin.produtos.index');
    Route::get('/produtos/criar', [ProdutoController::class, 'create'])->name('admin.produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('admin.produtos.store');
    Route::get('/produtos/{id}/editar', [ProdutoController::class, 'edit'])->name('admin.produtos.edit');
    Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('admin.produtos.update');
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('admin.produtos.destroy');
});

/*
|--------------------------------------------------------------------------
| Rotas de API para dados simulados
|--------------------------------------------------------------------------
*/
Route::get('/api/metricas', [AdminController::class, 'metricas'])->name('api.metricas');
Route::get('/api/vendas-recentes', [AdminController::class, 'vendasRecentes'])->name('api.vendas.recentes');
Route::get('/api/produtos-populares', [ProdutoController::class, 'populares'])->name('api.produtos.populares');

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