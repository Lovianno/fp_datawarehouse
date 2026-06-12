<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

// Routes akan ditambahkan di sini

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/users', UserController::class)->names('users');
        Route::resource('/produk', ProdukController::class)->names('produk');

    });

require __DIR__ . '/auth.php';


