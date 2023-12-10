<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\app\Http\Controllers\LoginController;
use Modules\Auth\app\Http\Controllers\LogoutController;
use Modules\Auth\app\Http\Controllers\RegisterController;

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

Route::prefix('v1')->name('api.')->group(function () {

    Route::post("login", LoginController::class);
    Route::post("register", RegisterController::class);


    Route::middleware(['auth:sanctum'])->group(function () {

        Route::post("logout", [LoginController::class , 'logout']);
    });
});



