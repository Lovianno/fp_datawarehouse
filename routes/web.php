<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\WarehouseController;

// Routes akan ditambahkan di sini



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/users', UserController::class)->names('users');

    Route::resource('/penjualan', PenjualanController::class)->names('penjualan');
    Route::resource('/users', UserController::class)->names('users');
    Route::resource('/pelanggan', PelangganController::class)->names('pelanggan');
    Route::resource('/produk', ProdukController::class)->names('produk');

    Route::patch('/extract', [WarehouseController::class, 'convertToWarehouse'])->name('extract.convert');
});

require __DIR__ . '/auth.php';
