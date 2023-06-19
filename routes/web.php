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

// Rute dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
});

// Rute pendaftaran
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Rute login
Route::get('/login', [SessionsController::class, 'create'])->name('login.create');
Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

// Rute logout
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

// Rute administrator
Route::middleware('auth', 'administrator')->group(function () {
    // Rute untuk manajemen admin unit
    Route::get('/adminunits', [UserController::class, 'index'])->name('administrator.adminunits.index');
    Route::post('/adminunits', [UserController::class, 'store'])->name('administrator.adminunits.store');
    Route::get('/adminunits/create', [UserController::class, 'create'])->name('administrator.adminunits.create');
    Route::get('/adminunits/{adminunit}/edit', [UserController::class, 'edit'])->name('administrator.adminunits.edit');
    Route::put('/adminunits/{adminunit}', [UserController::class, 'update'])->name('administrator.adminunits.update');
    Route::delete('/adminunits/{adminunit}', [UserController::class, 'destroy'])->name('administrator.adminunits.destroy');

    // Rute untuk manajemen unit
    Route::get('/units', [UnitController::class, 'index'])->name('administrator.units.index');
    Route::post('/units', [UnitController::class, 'store'])->name('administrator.units.store');
    Route::get('/units/create', [UnitController::class, 'create'])->name('administrator.units.create');
    Route::get('/units/{unit}/edit', [UnitController::class, 'edit'])->name('administrator.units.edit');
    Route::put('/units/{unit}', [UnitController::class, 'update'])->name('administrator.units.update');
    Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('administrator.units.destroy');

    // Rute untuk manajemen kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('administrator.categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('administrator.categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('administrator.categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('administrator.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('administrator.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('administrator.categories.destroy');
});

// Rute unit admin
Route::middleware('auth', 'unitadmin')->group(function () {
    // Rute untuk manajemen item
    Route::get('/items', [ItemController::class, 'index'])->name('unitadmin.items.index');
    Route::post('/items', [ItemController::class, 'store'])->name('unitadmin.items.store');
    Route::get('/items/create', [ItemController::class, 'create'])->name('unitadmin.items.create');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('unitadmin.items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('unitadmin.items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('unitadmin.items.destroy');

    // Rute untuk menampilkan daftar booking dan approval peminjaman
    Route::get('/bookings', [BookingController::class, 'index'])->name('unitadmin.bookings.index');
    Route::post('/bookings', [ItemController::class, 'store'])->name('unitadmin.bookings.store');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('unitadmin.bookings.update');
    Route::get('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('unitadmin.bookings.approve');

    // Rute untuk melihat daftar penggunaan barang, dan mengembalikan barang
    Route::get('/usages', [UsageController::class, 'index'])->name('unitadmin.usages.index');
    Route::get('/usages/{usage}', [UsageController::class, 'show'])->name('unitadmin.usages.show');
    Route::put('/usages/{usage}', [UsageController::class, 'update'])->name('unitadmin.usages.update');
    Route::get('usages/{usage}/return', [UsageController::class, 'return'])->name('unitadmin.usages.return');
    Route::delete('/usages/{usage}', [UsageController::class, 'destroy'])->name('unitadmin.usages.destroy');
});

// Rute borrower
Route::middleware('auth', 'borrower')->group(function () {
    // Rute untuk melengkapi profil
    Route::get('/profile', [UserController::class, 'edit'])->name('borrower.profile.edit');
    Route::get('/profile/{user}/edit', [UserController::class, 'editProfile'])->name('borrower.profile.edit');
    Route::put('/profile/{user}', [UserController::class, 'updateProfile'])->name('borrower.profile.update');

    // Rute untuk mengajukan booking
    Route::get('/bookings', [BookingController::class, 'index'])->name('borrower.bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('borrower.bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('borrower.bookings.store');
    
    // Rute untuk melihat ketersediaan barang
    Route::get('/items', [ItemController::class, 'index'])->name('borrower.items.index');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('borrower.items.show');

    // Rute untuk mencetak bukti peminjaman
    Route::get('/bookings/{booking}/print', [BookingController::class, 'print'])->name('borrower.bookings.print');
});