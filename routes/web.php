<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'getRegisterForm'])->name('register');
Route::get('/login', [AuthController::class, 'getLoginForm'])->name('login');
Route::get('/avatar', [ProfileController::class, 'getForm'])->name('avatar');
