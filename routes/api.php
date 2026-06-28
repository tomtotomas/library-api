<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GenresController;
use App\Http\Middleware\CheckRole;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// PUBLIC ROUTES
Route::post('/register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// GENRE PUBLIC ROUTES
Route::get('/genres', [App\Http\Controllers\Api\GenresController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    
    // PROTECTED ROUTES
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/me', [App\Http\Controllers\Api\AuthController::class, 'me']);

    // ADMIN ROUTES
    Route::middleware('role:admin')->group(function () {

        Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'index']);

        // GENRE ADMIN ROUTES / CRUD
        Route::post('/genre', [App\Http\Controllers\Api\GenresController::class, 'store']);
        Route::get('/genre/{id}', [App\Http\Controllers\Api\GenresController::class, 'show']);
        Route::put('/genre/{id}', [App\Http\Controllers\Api\GenresController::class, 'update']);
        Route::delete('/genre/{id}', [App\Http\Controllers\Api\GenresController::class, 'destroy']);


    });

});
