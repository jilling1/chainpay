<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('/logout', function () { \Auth::logout(); return redirect('login'); });

    Route::get('/company-info', 'UserController@companyInfo')->name('company-info');
    Route::get('/account-settings', 'UserController@accountSettings')->name('account-settings');
//    Route::get('/payments', 'PaymentsController@payments')->name('payments');
    Route::get('/', 'PaymentsController@payments')->name('payments');

    Route::post('/seller-details', 'UserController@saveSellerDetails')->name('save-seller-details');
    Route::post('/user-email', 'UserController@saveUserEmail')->name('save-email');
    Route::post('/user-password', 'UserController@saveUserPassword')->name('save-password');
    Route::post('/wallets-addresses', 'UserController@saveWalletsAddresses')->name('save-wallets-addresses');
});

Route::get('create-address-endpoint', 'TestController@createAddress');