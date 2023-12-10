<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Products\app\Http\Controllers\ProductsController;

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

//middleware(['auth:sanctum'])->
Route::prefix('v1')->name('api.')->group(function () {

    Route::apiResource("products", ProductsController::class)->only('index', 'show');
});
