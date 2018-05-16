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

Route::get('/', array('as' => 'dashboard', 'uses' => 'DashboardController@index'));

Route::group(['prefix' => 'user-management', 'namespace' => 'UserManagement'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('', array('as' => 'user-management.user.index', 'uses' => 'UserController@index'));
        Route::get('create', array('as' => 'user-management.user.create', 'uses' => 'UserController@create'));
        Route::post('store', array('as' => 'user-management.user.store', 'uses' => 'UserController@store'));
        Route::get('{id}/edit', array('as' => 'user-management.user.edit', 'uses' => 'UserController@edit'));
        Route::patch('{id}/update', array('as' => 'user-management.user.update', 'uses' => 'UserController@update'));
        Route::delete('{id}/delete', array('as' => 'user-management.user.destroy', 'uses' => 'UserController@destroy'));
    });
});
