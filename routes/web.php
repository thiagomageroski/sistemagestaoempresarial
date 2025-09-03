<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');
Route::get('/cadastro', [HomeController::class, 'cadastro'])->name('cadastro');
Route::get('/login', [HomeController::class, 'login'])->name('login');

// Rotas de produtos (protegidas - requerem autenticação)
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/{slug}', [ProdutoController::class, 'show'])->name('produtos.show');

/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/cadastro', [AuthController::class, 'register'])->name('register');

// Rota de login administrativo (se ainda for necessária)
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');

/*
|--------------------------------------------------------------------------
| Área Administrativa
|--------------------------------------------------------------------------
*/
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/clientes', [ClienteController::class, 'index'])->name('admin.clientes.index');
    Route::get('/admin/clientes/{id}', [ClienteController::class, 'show'])->name('admin.clientes.show');
});

/*
|--------------------------------------------------------------------------
| Rotas de API para dados simulados
|--------------------------------------------------------------------------
*/
Route::get('/api/metricas', [AdminController::class, 'metricas'])->name('api.metricas');
Route::get('/api/vendas-recentes', [AdminController::class, 'vendasRecentes'])->name('api.vendas.recentes');