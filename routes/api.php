<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/login', [UserController::class, 'login']);
    Route::get('/register', [UserController::class, 'register']);
});