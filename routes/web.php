<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

// Guest Routes
Route::middleware('guest')->group(function () {
    // Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    // Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/berita-acara', [\App\Http\Controllers\BeritaAcaraController::class, 'index'])->name('berita-acara.index');
    Route::get('/berita-acara/create', [\App\Http\Controllers\BeritaAcaraController::class, 'create'])->name('berita-acara.create');
    Route::post('/berita-acara', [\App\Http\Controllers\BeritaAcaraController::class, 'store'])->name('berita-acara.store');
    Route::delete('/berita-acara/{beritaAcara}', [\App\Http\Controllers\BeritaAcaraController::class, 'destroy'])->name('berita-acara.destroy');

    // User Management (Admin Only)
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');
    });
});
