<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\BookController;
use App\Http\Middleware\CheckRole;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// PUBLIC ROUTES
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// GENRE PUBLIC ROUTES
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{genre}', [GenreController::class, 'show']);

// BOOK PUBLIC ROUTES
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    
    // PROTECTED ROUTES
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // ADMIN ROUTES
    Route::middleware('role:admin')->group(function () {

        Route::get('/users', [UserController::class, 'index']);

        // GENRE ADMIN ROUTES / CRUD 
        Route::match(['put', 'patch'], '/genres/{genre}', [GenreController::class, 'update']);
        Route::post('/genres', [GenreController::class, 'store']);
        Route::delete('/genres/{genre}', [GenreController::class, 'destroy']);

        // BOOK ADMIN ROUTES / CRUD 
        Route::match(['put', 'patch'], '/books/{book}', [BookController::class, 'update']);
        Route::post('/books', [BookController::class, 'store']);
        Route::delete('/books/{book}', [BookController::class, 'destroy']);

    });

});