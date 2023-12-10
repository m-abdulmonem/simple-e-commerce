<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Orders\app\Http\Controllers\OrdersController;

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

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::apiResource("orders", OrdersController::class)->only("index", 'store');

    Route::get("test", function (){
        $details = [
            'title' => __('New order had been placed 1111'),
            'order_id' =>1000
        ];

        event(new  \Modules\Orders\app\Events\OrderNotifyEvent($details));
    });
});
