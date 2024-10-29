<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

Route::group([
    'prefix' => 'auth'
],function () {
    Route::post('/register',[UserController::class, 'register']);
    Route::post('/login',[UserController::class, 'login']);
});

Route::group([
    'prefix' => 'product'
    // 'middleware' => 'auth:api'
],function () {
    Route::get('/product-all', [ProductController::class, 'index']);
});
