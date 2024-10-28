<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth'
],function () {

});

Route::group([
    'prefix' => 'product',
    'middleware' => 'auth:api'
],function () {
    
});
