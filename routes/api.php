<?php

use App\Http\Controllers\Api\CakeController;
use App\Http\Controllers\Api\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => config('api.version')], function() {

    Route::group(['prefix' => 'cakes'], function() {
        Route::get('/', [CakeController::class, "index"]);
        Route::get('/{id}', [CakeController::class, "show"]);
        Route::post('/', [CakeController::class, "store"]);
        Route::put('/{id}', [CakeController::class, "update"]);
        Route::delete('/{id}', [CakeController::class, "destroy"]);

        Route::post('/{id}/subscribe', [SubscribeController::class, "subscribe"]);
    });

});
