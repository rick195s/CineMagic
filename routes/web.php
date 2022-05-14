<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// auth routes (login, logout, register, forgot password, reset password)
Auth::routes(['verify' => true]);


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');


// protected routes (only for admins)
// routes with prefix admin
// routes with admin. prefix in the name of the route
Route::middleware(['isAdmin'])->prefix('admin')->name('admin.')->group(function () {

    // // admin dashboard main page
    // Route::get('/', [DashboardController::class, 'index'])->name('index');

    // // admin dashboard manage users
    // Route::get('/users', [UserController::class, 'admin_index'])->name('users.index');
    Route::resource('user', UserController::class);

    // // admin dashboard manage salas
    // Route::get('/salas', [SalaController::class, 'admin_index'])->name('salas.index');

    // // admin dashboard manage filmes
    // Route::get('/filmes', [FilmeController::class, 'admin_index'])->name('filmes.index');

    // // admin dashboard manage sessoes
    // Route::get('/sessoes', [SessaoController::class, 'admin_index'])->name('sessoes.index');
});
