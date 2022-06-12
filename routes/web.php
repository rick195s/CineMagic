<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SalaController;
use App\Http\Controllers\Admin\SessaoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FilmeController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FilmeFrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessaoFrontController;
use App\Policies\DashboardPolicy;
use Illuminate\Support\Facades\Auth;
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

// rotas de autentificação, verify => true, faz a verificação de email
Auth::routes(['verify' => true]);


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ClienteController::class, 'index'])->name('client.profile');


// rotas para alteração da password
Route::get('/password/change', [ChangePasswordController::class, 'index'])->name('change_password.index');
Route::post('/password/change', [ChangePasswordController::class, 'update'])->name('change_password.update');

// rotas para escolher o lugar de uma sessao e depois comprar bilhete
Route::get('/sessoes/{sessao}/seat', [SessaoFrontController::class, 'selectSeat'])->name('sessao.select_seat');

// rotas para filmes no front end
Route::get('/filmes/{filme}', [FilmeFrontController::class, 'show'])->name('filmes.show');

// rotas relacionadas com a gestão do carrinho
Route::get('/carrinho/checkout', [CarrinhoController::class, 'index'])->name('checkout.index');
Route::post('/carrinho/checkout', [CarrinhoController::class, 'confirmarCompra'])->name('carrinho.checkout')->middleware('auth');
Route::get('/carrinho/{sessao}', [CarrinhoController::class, 'adicionarSessao'])->name('carrinho.add_sessao');
Route::get('/carrinho/{sessao}/{lugar}', [CarrinhoController::class, 'adicionarLugar'])->name('carrinho.add_lugar');
Route::delete('/carrinho/delete/{sessao}', [CarrinhoController::class, 'removerSessao'])->name('carrinho.delete_sessao');
Route::delete('/carrinho/delete/{sessao}/{lugar}', [CarrinhoController::class, 'removerLugar'])->name('carrinho.delete_lugar');
Route::delete('/carrinho/empty', [CarrinhoController::class, 'limpar'])->name('carrinho.empty');

Route::prefix('admin')->name('admin.')->group(function () {
    // admin dashboard main page

    Route::middleware(['isEmployee'])->group(function () {
    });
    // rotas protegidas (só para admins)
    // rotas com prefixo admin
    // rotas com o prefixo admin. no seu nome
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::post('/settings', [DashboardController::class, 'settings'])->name('settings.update');

        // rotas para gerir users no dashboard admin
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/update_state', [UserController::class, 'updateState'])->name('users.update_state');

        // admin dashboard manage salas
        Route::resource('salas', SalaController::class);

        // // admin dashboard manage filmes
        Route::resource('filmes', FilmeController::class);

        // admin dashboard manage sessoes
        Route::resource('sessoes', SessaoController::class);
    });
});

// rotas protegidas so para funcionarios
