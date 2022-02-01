<?php

use App\Http\Controllers\CaixaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/login')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('login.index');
    Route::post('/', [UsuarioController::class, 'store'])->name('login.store');
    Route::get('/logout', [UsuarioController::class, 'logout'])->name('login.logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('page.dashboard');

Route::prefix("/clientes")->group(function() {
    Route::get('/', [ClienteController::class, 'index'])->name('cliente.index');
    Route::post('/', [ClienteController::class, 'store'])->name('cliente.store');
    Route::post('/edit', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::put('/update', [ClienteController::class, 'update'])->name('cliente.update');
    Route::delete('/delete/{id}', [ClienteController::class, 'destroy'])->name('cliente.delete');
});

Route::prefix('/produtos')->group(function() {
    Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
    Route::post('/', [ProdutoController::class, 'store'])->name('produto.store');
    Route::get('/get-all', [ProdutoController::class, 'getAll'])->name('produto.getAll');
    Route::post('/edit', [ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('/update', [ProdutoController::class, 'update'])->name('produto.update');
    Route::delete('/delete/{id}', [ProdutoController::class, 'destroy'])->name('produto.delete');
});

Route::prefix('/categorias')->group(function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('/', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::post('/edit', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::put('/update', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/delete/{id}', [CategoriaController::class, 'destroy'])->name('categoria.delete');
});

Route::prefix('/vendas')->group(function () {
    Route::get('/', [VendaController::class, 'index'])->name('venda.index');
    Route::get('/realizar-venda', [VendaController::class, 'create'])->name('venda.create');
    Route::post('/', [VendaController::class, 'store'])->name('venda.store');
});

Route::prefix('/compras')->group(function () {
    Route::get('/', [CompraController::class, 'index'])->name('compra.index');
    Route::get('/registrar-compra', [CompraController::class, 'create'])->name('compra.create');
});

Route::prefix('/fornecedores')->group(function() {
    Route::get('/', [FornecedorController::class, 'index'])->name('fornecedor.index');
    Route::post('/', [FornecedorController::class, 'store'])->name('fornecedor.store');
    Route::post('/edit', [FornecedorController::class, 'edit'])->name('fornecedor.edit');
    Route::put('/update', [FornecedorController::class, 'update'])->name('fornecedor.update');
    Route::delete('/delete/{id}', [FornecedorController::class, 'destroy'])->name('fornecedor.delete');
});

Route::prefix('/financas')->group(function() {
    Route::prefix('caixas')->group(function() {
        Route::get('/', [CaixaController::class, 'index'])->name('caixa.index');
        Route::post('/', [CaixaController::class, 'store'])->name('caixa.store');
        Route::post('/edit', [CaixaController::class, 'edit'])->name('caixa.edit');
        Route::put('/ativar/{id}', [CaixaController::class, 'ativar'])->name('caixa.ativar');
        Route::put('/desativar/{id}', [CaixaController::class, 'desativar'])->name('caixa.desativar');
        Route::put('/update', [CaixaController::class, 'update'])->name('caixa.update');
        Route::delete('/delete/{id}', [CaixaController::class, 'destroy'])->name('caixa.delete');
    });
});

Route::prefix('/funcionarios')->group(function() {
    Route::get('/', [FuncionarioController::class, 'index'])->name('funcionario.index');
    Route::post('/', [FuncionarioController::class, 'store'])->name('funcionario.store');
    Route::post('/edit', [FuncionarioController::class, 'edit'])->name('funcionario.edit');
    Route::put('/update', [FuncionarioController::class, 'update'])->name('funcionario.update');
    Route::delete('/delete/{id}', [FuncionarioController::class, 'destroy'])->name('funcionario.delete');
});
