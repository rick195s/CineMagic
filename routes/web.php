<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Auth::routes();


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// protected routes (only for admins)
Route::middleware(['isAdmin'])->group(function () {

    // routes with prefix admin
    // routes with admin. prefix in the name of the route
    Route::prefix('admin')->name('admin.')->group(function () {
        // // admin dashboard main page
        // Route::get('/', [DashboardController::class, 'index'])->name('index');

        // // admin dashboard manage users
        // Route::get('/users', [DashboardController::class, 'index'])->name('users.index');

        // // admin dashboard manage salas
        // Route::get('/salas', [DashboardController::class, 'index'])->name('salas.index');

        // // admin dashboard manage filmes
        // Route::get('/filmes', [DashboardController::class, 'index'])->name('filmes.index');

        // // admin dashboard manage sessoes
        // Route::get('/sessoes', [DashboardController::class, 'index'])->name('sessoes.index');
    });
});
