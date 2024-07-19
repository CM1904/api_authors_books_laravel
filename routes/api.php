<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/authors', [AuthorsController::class, 'index']);
    Route::get('/authors/{id}', [AuthorsController::class, 'show']);
    Route::post('/authors', [AuthorsController::class, 'store']);
    Route::put('/authors/{id}', [AuthorsController::class, 'update']);
    Route::delete('/authors/{id}', [AuthorsController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/books', [BooksController::class, 'index']);
    Route::get('/books/{id}', [BooksController::class, 'show']);
    Route::post('/books', [BooksController::class, 'store']);
    Route::put('/books/{id}', [BooksController::class, 'update']);
    Route::delete('/books/{id}', [BooksController::class, 'destroy']);
});

//Login y registro de usuarios
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
//Authors endpoints
Route::get('/authors', [AuthorsController::class, 'index']);
Route::get('/authors/{id}', [AuthorsController::class, 'show']);
Route::post('/authors', [AuthorsController::class, 'store']);
Route::put('/authors/{id}', [AuthorsController::class, 'update']);
Route::delete('/authors/{id}', [AuthorsController::class, 'destroy']);
//Books endpoints
Route::get('/books', [BooksController::class, 'index']);
Route::get('/books/{id}', [BooksController::class, 'show']);
Route::post('/books', [BooksController::class, 'store']);
Route::put('/books/{id}', [BooksController::class, 'update']);
Route::delete('/books/{id}', [BooksController::class, 'destroy']);

