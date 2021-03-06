<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SalaController;
use App\Http\Controllers\Admin\SessaoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FilmeController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\BilheteController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FilmeFrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessaoFrontController;
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

Route::middleware(['isClient'])->group(function () {
    Route::get('/profile', [ClienteController::class, 'index'])->name('client.profile');
    Route::post('/profile', [ClienteController::class, 'update'])->name('client.profile.update');
    Route::get('/recibos', [ClienteController::class, 'recibos'])->name('client.recibos');
    Route::get('/recibos/{recibo}', [ClienteController::class, 'recibo'])->name('client.recibos.download');
    Route::get('/recibos/{recibo}/bilhetes', [ClienteController::class, 'bilhetes'])->name('client.bilhetes');
    Route::get('/bilhetes/{bilhete}', [ClienteController::class, 'bilhete'])->name('client.bilhetes.download');

    Route::post('/carrinho/checkout', [CarrinhoController::class, 'confirmarCompra'])->name('carrinho.checkout')->middleware('auth');
});

// rotas para alteração da password
Route::get('/password/change', [ChangePasswordController::class, 'index'])->name('change_password.index');
Route::post('/password/change', [ChangePasswordController::class, 'update'])->name('change_password.update');

// rotas para escolher o lugar de uma sessao e depois comprar bilhete
Route::get('/sessoes/{sessao}/seat', [SessaoFrontController::class, 'selectSeat'])->name('sessao.select_seat');

// rotas para filmes no front end
Route::get('/filmes/{filme}', [FilmeFrontController::class, 'show'])->name('filmes.show');

// rotas relacionadas com a gestão do carrinho
Route::get('/carrinho/checkout', [CarrinhoController::class, 'index'])->name('checkout.index');
Route::post('/carrinho/{sessao}', [CarrinhoController::class, 'adicionarSessao'])->name('carrinho.add_sessao');
Route::post('/carrinho/{sessao}/{lugar}', [CarrinhoController::class, 'adicionarLugar'])->name('carrinho.add_lugar');
Route::delete('/carrinho/delete/{sessao}', [CarrinhoController::class, 'removerSessao'])->name('carrinho.delete_sessao');
Route::delete('/carrinho/delete/{sessao}/{lugar}', [CarrinhoController::class, 'removerLugar'])->name('carrinho.delete_lugar');
Route::delete('/carrinho/empty', [CarrinhoController::class, 'limpar'])->name('carrinho.empty');

// rotas em que um empregado e administrador podem ver em comum
// rotas com prefixo admin
// rotas com o prefixo admin. no seu nome
Route::middleware('can:view-dashboard')->prefix('admin')->name('admin.')->group(function () {

    Route::get('sessoes', [SessaoController::class, 'index'])->name('sessoes.index');

    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::match(['put', 'patch'], 'users/{user}', [UserController::class, 'update'])->name('users.update');

    // rotas protegidas (só para funcionarios)
    Route::middleware(['isEmployee'])->group(function () {
        Route::get('sessoes/{sessao}/manage', [SessaoController::class, 'manage'])->name('sessoes.manage');
        Route::patch('bilhetes/{bilhete}/use', [BilheteController::class, 'use'])->name('bilhetes.use');
    });

    // rotas protegidas (só para admins)
    Route::middleware(['isAdmin'])->group(function () {
        // admin dashboard main page
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::post('/settings', [DashboardController::class, 'settings'])->name('settings.update');

        // rotas para gerir users no dashboard admin
        Route::resource('users', UserController::class)->except('show', 'update');
        Route::patch('users/{user}/update_state', [UserController::class, 'updateState'])->name('users.update_state');

        // admin dashboard manage salas
        Route::resource('salas', SalaController::class);

        // // admin dashboard manage filmes
        Route::resource('filmes', FilmeController::class);

        // admin dashboard manage sessoes
        Route::resource('sessoes', SessaoController::class)->parameters(['sessoes' => 'sessao'])->except('index');
    });
});
