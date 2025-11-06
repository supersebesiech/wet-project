<?php

use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'create']);
Route::post('/logout', [SessionController::class, 'create']);

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('register', [RegisteredUserController::class, 'store']);

Route::view('/for-you', 'user.for-you');

Route::get('reset', [PasswordResetController::class, 'create']);
Route::post('/reset', [PasswordResetController::class, 'send']);
