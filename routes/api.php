<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

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


Route::prefix('/user')->group(function() {
    Route::post('/login', 'App\Http\Controllers\LoginController@login');
    Route::post('/register', 'App\Http\Controllers\LoginController@register');
});

Route::middleware('auth:api')->group( function () {
    Route::apiResource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::get('/export', [\App\Http\Controllers\BookController::class,'export']);
  

});