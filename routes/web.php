<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;

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

Route::get('/', function () { return view('index'); })->name('site.index');

Route::prefix('/clientes')->group(function() {
    Route::get('/index', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/store', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/delete/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});

Route::prefix('/fornecedores')->group(function() {
    Route::get('/index', [FornecedorController::class, 'index'])->name('fornecedores.index');
    Route::get('/create', [FornecedorController::class, 'create'])->name('fornecedores.create');
    Route::post('/store', [FornecedorController::class, 'store'])->name('fornecedores.store');
    Route::get('/edit/{id}', [FornecedorController::class, 'edit'])->name('fornecedores.edit');
    Route::put('/update/{id}', [FornecedorController::class, 'update'])->name('fornecedores.update');
    Route::delete('/delete/{id}', [FornecedorController::class, 'destroy'])->name('fornecedores.destroy');
});

Route::prefix('/produtos')->group(function() {
    Route::get('/index', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/store', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/delete/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
});

Route::prefix('/vendas')->group(function() {
    Route::get('/index', [VendaController::class, 'index'])->name('vendas.index');
    Route::get('/create', [VendaController::class, 'create'])->name('vendas.create');
    Route::get('/show/{id}', [VendaController::class, 'show'])->name('vendas.show');
    Route::post('/store', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/edit/{id}', [VendaController::class, 'edit'])->name('vendas.edit');
    Route::put('/update/{id}', [VendaController::class, 'update'])->name('vendas.update');
    Route::delete('/delete/{id}', [VendaController::class, 'destroy'])->name('vendas.destroy');
});

Route::prefix('/compras')->group(function() {
    Route::get('/index', [CompraController::class, 'index'])->name('compras.index');
    Route::get('/create', [CompraController::class, 'create'])->name('compras.create');
    Route::get('/show/{id}', [CompraController::class, 'show'])->name('compras.show');
    Route::post('/store', [CompraController::class, 'store'])->name('compras.store');
    Route::get('/edit/{id}', [CompraController::class, 'edit'])->name('compras.edit');
    Route::put('/update/{id}', [CompraController::class, 'update'])->name('compras.update');
    Route::delete('/delete/{id}', [CompraController::class, 'destroy'])->name('compras.destroy');
});
