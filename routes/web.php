<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/chat')->group(function () {
    Route::get('/', [ChatController::class, 'index']);
    Route::post('/send', [ChatController::class, 'send']);
});

Route::prefix('user')->group(function () {
    Route::any('/login', [UserController::class, 'login']);
    Route::any('/register', [UserController::class, 'register']);
});