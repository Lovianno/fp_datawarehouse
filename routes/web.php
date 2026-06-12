<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

// Routes akan ditambahkan di sini

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

               Route::resource('/users', UserController::class)->names('users');
               Route::resource('/pelanggan', PelangganController::class)->names('pelanggan');

    });

require __DIR__ . '/auth.php';


