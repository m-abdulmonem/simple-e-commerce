<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Carts\app\Http\Controllers\CartsController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->controller(CartsController::class)->group(function () {
    Route::get('carts', 'index');

    Route::prefix("cart")->group(function (){
        Route::post('add/{product}', 'addToCart');
        Route::delete('delete/{product}', 'deleteProductFromCart');
        Route::post('quantity/update/{product}', 'updateQuantity');
    });
});
