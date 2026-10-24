<?php

use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\PengaduanController as CustomerPengaduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// Hanya untuk yang belum login
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout: harus sudah login
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Area admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::put('/pengaduan/{pengaduan}/status', [AdminPengaduanController::class, 'updateStatus'])
            ->name('pengaduan.updateStatus');
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    });

// Area customer
Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function (): void {
        Route::get('/dashboard', [DashboardController::class, 'customer'])->name('dashboard');
        Route::get('/pengaduan', [CustomerPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/create', [CustomerPengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [CustomerPengaduanController::class, 'store'])->name('pengaduan.store');
    });