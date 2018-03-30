<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/payment-create', 'API\PaymentsController@paymentCreate')->name('payment-create');
Route::get('/payment-status/{paymentToken}', 'API\PaymentsController@paymentStatus')->name('payment-status');
Route::post('/payment-callback', 'API\PaymentsController@paymentCallback')->name('payment-callback');
