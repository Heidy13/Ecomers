<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::group([
    'prefix' => 'auth'
],function () {

});

Route::group([
    'prefix' => 'product'
    // 'middleware' => 'auth:api'
],function () {
    Route::get('/product-all', [ProductController::class, 'index']);
});
