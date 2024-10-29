<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

Route::group([
    'prefix' => 'auth'
],function () {
    Route::post('/register',[UserController::class, 'register']);
    Route::post('/login',[UserController::class, 'login']);
    Route::put('/update/{id}',[UserController::class, 'edit']);
    Route::post('/logout',[UserController::class, 'logout'])->middleware('auth:api');
});

Route::group([  
    'prefix' => 'product',
    'middleware' => 'auth:api'
],function () {
    Route::get('/productAll', [ProductController::class, 'index']);
    Route::post('/createProduct', [ProductController::class, 'store']);
    Route::put('/editProduct/{id}', [ProductController::class, 'update']);
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy']);
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth:api'
],function () {
    Route::post('/store',[CategoryController::class, 'store']);
    Route::put('/update/{id}',[CategoryController::class, 'update']);
});

