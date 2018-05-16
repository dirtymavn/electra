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

Route::get('login', array('as' => 'auth.login', 'uses' => 'LoginController@index'));
