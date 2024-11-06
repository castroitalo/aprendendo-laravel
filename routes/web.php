<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// Auth routes - user not logged
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
});

// App routes - user logged
Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/new-note', [MainController::class, 'newNote'])->name('newNote');
    Route::post('/new-note-submit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');
    Route::get('/edit-note', [MainController::class, 'editNote'])->name('editNote');
    Route::get('/delete-note', [MainController::class, 'deleteNote'])->name('deleteNote');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
