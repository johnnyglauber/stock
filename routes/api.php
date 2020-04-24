<?php

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

Route::group([
    'prefix' => 'auth'
], function () {

    Route::post('login', 'AuthController@login');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');

        Route::post('stock-movements/place', 'Api\StockMovementApiController@place');
        Route::post('stock-movements/remove', 'Api\StockMovementApiController@remove');
        Route::post('adicionar-produtos', 'Api\StockMovementApiController@place');
        Route::post('baixar-produtos', 'Api\StockMovementApiController@remove');
    });
});
