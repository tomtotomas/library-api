<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\CheckRole;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/me', [App\Http\Controllers\Api\AuthController::class, 'me']);
    Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'index'])->middleware('role:admin');

});
