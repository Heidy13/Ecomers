<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::group([
    'prefix' => 'auth'
],function () {

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

