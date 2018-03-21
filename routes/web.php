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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () { \Auth::logout(); return redirect('login'); });
    Route::get('/profile', function () { return 'TODO'; })->name('profile');
    Route::get('/account-settings', 'UserController@accountSettings')->name('account-settings');

    Route::post('/seller_details', 'UserController@saveSellerDetails')->name('save-seller-details');
});