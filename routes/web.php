<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\UserController;

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
    if (auth()->check()) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
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

// Dashboard
Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

// Routes for Categories
Route::resource('categories', CategoryController::class);

// Routes for Units
Route::resource('units', UnitController::class);

// Routes for Admins
Route::resource('admins', AdminController::class);

// Routes for Items
Route::resource('items', ItemController::class);

// Routes for Bookings
Route::resource('bookings', BookingController::class);
Route::view('/booking', 'unitadmin.bookings.index');

// Routes for Usages
Route::resource('usages', UsageController::class);

// Routes for Users
Route::resource('users', UserController::class);