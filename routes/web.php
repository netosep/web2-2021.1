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

// rota teste
// Route::get('/', [UsuarioController::class, 'index'])->name('page.login');
Route::get('/', [DashboardController::class, 'index'])->name('page.dashboard');

Route::get('/login', [UsuarioController::class, 'index'])->name('page.login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('page.dashboard');

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produto.index');

Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.index');

Route::prefix('/categorias')->group(function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categoria.index');
    //Route::get('/create', [CategoriaController::class, 'create'])->name('categoria.create');
    Route::post('/store', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::get('/edit/{id}', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::post('/update/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::get('/destroy/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
});

Route::prefix('/vendas')->group(function () {
    Route::get('/', [VendaController::class, 'index'])->name('venda.index');
    Route::get('/realizar-venda', [VendaController::class, 'create'])->name('venda.create');
});

Route::prefix('/compras')->group(function () {
    Route::get('/', [CompraController::class, 'index'])->name('compra.index');
    Route::get('/registrar-compra', [CompraController::class, 'create'])->name('compra.create');
});

Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedor.index');

Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionario.index');

Route::get('/caixas', [CaixaController::class, 'index'])->name('caixa.index');