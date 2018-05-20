<?php

/*
|--------------------------------------------------------------------------
| auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "auth" middleware group. Now create something great!
|
*/
Route::get('login', array('as' => 'auth.login', 'uses' => 'AuthController@create'));
Route::get('forgot-password', array('as' => 'auth.forgot', 'uses' => 'AuthController@forgot'));
Route::post('login/store', array('as' => 'auth.login.store', 'uses' => 'AuthController@store'));
// in Middleware Sentinel Auth
Route::group( [ 'middleware' => 'sentinel_auth' ], function () {
    Route::get('logout', [ 'as' => 'auth.logout', 'uses' => 'AuthController@logout' ]);
});
