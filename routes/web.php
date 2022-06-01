<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SalaController;
use App\Http\Controllers\Admin\SessaoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FilmeController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ClienteController;
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
Route::get('/profile', [ClienteController::class, 'index'])->name('client.profile');


// rotas para alteração da password
Route::get('/password/change', [ChangePasswordController::class, 'index'])->name('change_password.index');
Route::post('/password/change', [ChangePasswordController::class, 'update'])->name('change_password.update');

// rotas para escolher o lugar de uma sessao e depois comprar bilhete
Route::get('/sessao/{sessao}/seat', [SessaoFrontController::class, 'create_ticket'])->name('sessao.seat');

// rotas protegidas (só para admins)
// rotas com prefixo admin
// rotas com o prefixo admin. no seu nome
Route::middleware(['isAdmin'])->prefix('admin')->name('admin.')->group(function () {

    // admin dashboard main page
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::post('/settings', [DashboardController::class, 'settings'])->name('settings.update');


    // rotas para gerir users no dashboard admin
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/update_state', [UserController::class, 'update_state'])->name('users.update_state');

    // admin dashboard manage salas
    Route::resource('salas', SalaController::class);

    // // admin dashboard manage filmes
    Route::resource('filmes', FilmeController::class);

    // admin dashboard manage sessoes
    Route::resource('sessoes', SessaoController::class);
});
