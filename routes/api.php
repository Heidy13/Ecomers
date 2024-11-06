<?php

use App\Http\Controllers\Api\AbilityController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
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
    // 'middleware' => 'auth:api'
],function () {
    Route::get('/productAll', [ProductController::class, 'index']);
    Route::get('/productxid/{id}', [ProductController::class, 'ProductxId']);
    Route::post('/createProduct', [ProductController::class, 'store']);
    Route::put('/editProduct/{id}', [ProductController::class, 'update']);
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy']);
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth:api'
],function () {
    //crear categoria
    Route::post('/store',[CategoryController::class, 'store']);
    //editar categoria
    Route::put('/update/{id}',[CategoryController::class, 'update']);
    //eliminar reseñas
    Route::delete('/deleteReview/{id}',[ReviewController::class, 'delete']);
});

Route::group([
    'prefix' => 'craftsman',
    'middleware' => 'auth:api'
],function() {
    //ver habilidades
    Route::get('/index',[AbilityController::class, 'index']);
    //crear Habilidad
    Route::post('/store',[AbilityController::class, 'store']);
    //editar habilidad
    Route::put('/update/{id}',[AbilityController::class, 'update']);
    //ver habilidades por artesano
    Route::get('/show/{id}',[AbilityController::class, 'show']);

    //********************************PEDIDOS********************************** */
    //crear pedido
    Route::post('/storeOrder',[OrderController::class, 'store']);
    //editar estado del pedido
    Route::put('/updateOrder/{id}',[OrderController::class, 'update']);
});



Route::group([
    'prefix' => 'cart',
    'middleware' => 'auth:api'
],function () {
    Route::post('/createCart', [UserController::class, 'createCart']);
});
Route::post('/createCart', [UserController::class, 'createCart']);

Route::group([
    'prefix' => 'customer',
    'middleware' => 'auth:api'
],function () {
    //crear una reseña
    Route::post('/createReview', [ReviewController::class, 'store']);
    //ver reseñas a partir de id del producto
    Route::get('/review_product/{id}',[ReviewController::class, 'review_product']);
    //editar receña
    Route::put('/updateReview/{id}',[ReviewController::class,'update']);
    
});
