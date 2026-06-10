<?php

use Illuminate\Support\Facades\Route;

// Routes akan ditambahkan di sini

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('pages.auth.login');
});