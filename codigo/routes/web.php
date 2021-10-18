<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;

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

Route::get('/', function () { return view('welcome'); });

Route::get('/cliente/index', [ClienteController::class, 'index']);
Route::get('/cliente/create', [ClienteController::class, 'create']);
Route::post('/cliente/store', [ClienteController::class, 'store']);

Route::get('/fornecedor/index', [FornecedorController::class, 'index']);
Route::get('/fornecedor/create', [FornecedorController::class, 'create']);
Route::post('/fornecedor/store', [FornecedorController::class, 'store']);