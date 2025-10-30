<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\PratoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Rotas de autenticação
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Rotas protegidas (CRUDs e módulos)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // CRUDs RESTful
    Route::resource('clientes', ClienteController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('encomendas', EncomendaController::class);
    Route::resource('fornecedores', FornecedorController::class)->parameters([
        'fornecedores' => 'fornecedor'
    ]);
    Route::resource('ingredientes', IngredienteController::class);
    Route::resource('pratos', PratoController::class);
    Route::resource('produtos', ProdutoController::class)->parameters([
        'produtos' => 'produto'
    ]);
});

/*
|--------------------------------------------------------------------------
| Rotas de debug
|--------------------------------------------------------------------------
*/
Route::get('/user/{id}', function (string $id) {
    return 'User ' . $id;
});
