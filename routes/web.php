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
use App\Http\Controllers\UnitAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ReturnController;

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

// Rute root
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});

// Rute dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');
});

// Rute register
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Rute login
Route::get('/login', [SessionsController::class, 'create'])->name('login.create');
Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

// Rute logout
Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

// Rute untuk melengkapi profil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

// Rute administrator saja
Route::middleware('auth', 'administrator')->group(function () {

    // Rute untuk manajemen admin unit
    Route::get('/unitadmins', [UnitAdminController::class, 'index'])->name('unitadmins.index');
    Route::post('/unitadmins', [UnitAdminController::class, 'store'])->name('unitadmins.store');
    Route::get('/unitadmins/create', [UnitAdminController::class, 'create'])->name('unitadmins.create');
    Route::get('/unitadmins/{unitadmin}/show', [UnitAdminController::class, 'show'])->name('unitadmins.show');
    Route::get('/unitadmins/{unitadmin}/edit', [UnitAdminController::class, 'edit'])->name('unitadmins.edit');
    Route::put('/unitadmins/{unitadmin}/update', [UnitAdminController::class, 'update'])->name('unitadmins.update');
    Route::delete('/unitadmins/{unitadmin}', [UnitAdminController::class, 'destroy'])->name('unitadmins.destroy');

    // Rute untuk manajemen unit
    Route::get('/units', [UnitController::class, 'index'])->name('units.index');
    Route::get('/units/{unit}/show', [UnitController::class, 'show'])->name('units.show');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::get('/units/{unit}/edit', [UnitController::class, 'edit'])->name('units.edit');
    Route::put('/units/{unit}/update', [UnitController::class, 'update'])->name('units.update');
    Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');

    // Rute untuk manajemen kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Rute unit admin saja
Route::middleware('auth', 'unitadmin')->group(function () {

    // Rute untuk melihat daftar penggunaan barang
    Route::get('/usages', [UsageController::class, 'index'])->name('usages.index');
    Route::get('/usages/{usage}/show', [UsageController::class, 'show'])->name('usages.show');

    // Rute untuk mengedit usage atau set status menjadi "used"
    Route::get('/usages/{usage}/edit', [UsageController::class, 'edit'])->name('usages.edit');
    Route::put('/usages/{usage}/update', [UsageController::class, 'update'])->name('usages.update');
    Route::put('/item/{usage}/set-used', [UsageController::class, 'setUsed'])->name('usages.set-used');

    // Rute untuk mengembalikan barang
    Route::get('usages/{usage}/return', [ReturnController::class, 'show'])->name('usages.return.show');
    Route::put('usages/{usage}/return', [ReturnController::class, 'return'])->name('usages.return');
});

// Rute borrower saja
Route::middleware('auth', 'borrower')->group(function () {

    // Rute untuk mengajukan peminjaman
    Route::get('/bookings/{item}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/create', [BookingController::class, 'store'])->name('bookings.store');

    // Rute untuk menolak peminjaman
    Route::get('/bookings/{booking}/cancel', [ApprovalController::class, 'cancel'])->name('bookings.cancel');

    // Rute untuk mencetak bukti peminjaman
    Route::get('/bookings/{booking}/approval', [ApprovalController::class, 'generateApprovalLetter'])->name('bookings.approval');
});

Route::middleware(['auth', 'unitadminorborrower'])->group(function () {

    // Rute untuk manajemen item (unit admin)
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/{item}/show', [ItemController::class, 'show'])->name('items.show');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    // Rute untuk menampilkan daftar booking (unit admin)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}/show', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');

    // Rute untuk mengelola approval booking (unit admin)
    Route::get('/bookings/{booking}/approve', [ApprovalController::class, 'show'])->name('bookings.approve.show');
    Route::post('/bookings/{booking}', [ApprovalController::class, 'approve'])->name('bookings.approve');
    Route::get('/bookings/{booking}/reject', [ApprovalController::class, 'reject'])->name('bookings.reject');
});