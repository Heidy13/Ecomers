<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;


Route::group([
    'prefix' => 'auth'
],function () {
    Route::post('/register',[AuthController::class, 'register']);
    Route::post('/login',[AuthController::class, 'login']);
});

Route::group([
    'prefix' => 'product'
    // 'middleware' => 'auth:api'
],function () {
    Route::get('/product-all', [ProductController::class, 'index']);
});
