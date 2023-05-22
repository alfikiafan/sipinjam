<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Mengakses halaman pendaftaran
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');

// Menyimpan data pendaftaran
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Mengakses halaman login
Route::get('/login', [SessionsController::class, 'create'])->name('login.create');

// Menyimpan data login
Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

// Logout
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');
