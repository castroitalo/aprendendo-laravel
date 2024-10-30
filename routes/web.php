<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo 'Hello World!';
});

// Auth Routes
Route::get('/login', [AuthController::class, 'login']);
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
Route::get('/logout', [AuthController::class, 'logout']);