<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/avatar', [ProfileController::class, 'uploadAvatar'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout']);
