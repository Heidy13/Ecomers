<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'auth'
],function () {
    Route::post('/register',[AuthController::class, 'register']);
    Route::post('/login',[AuthController::class, 'login']);
});


Route::group([
    'middleware' => 'auth:api'
],function() {
    Route::post('/logout',[AuthController::class, 'logout']);
});

/*******************************PRODUCTO***************************************************/ 
Route::group([
    'prefix' => 'auth'
],function () {
    Route::apiResource('product',ProductController::class);
});

/*******************************CATEGORYA***************************************************/ 
Route::group([
    'prefix' => 'auth'
],function() {
    Route::apiResource('category',CategoryController::class);
});




