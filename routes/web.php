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
Route::group([ 'middleware' => 'sentinel_auth' ], function () {
    // Dashboard
    Route::get('/', array('as' => 'dashboard', 'uses' => 'DashboardController@index'));

    // Master
    Route::group(['prefix' => 'master', 'namespace' => 'Master'], function () {
        Route::resource('company', 'CompanyController')->middleware('sentinel_access:company');
        Route::get('export/excel/company', [ 'as' => 'export.company.excel', 'uses' => 'CompanyController@export_excel' ]);
        Route::get('export/pdf/company', [ 'as' => 'export.company.pdf', 'uses' => 'CompanyController@export_pdf' ]);
        Route::resource('role', 'RoleController');
    });

    // User Management
    Route::group(['prefix' => 'user-management', 'namespace' => 'UserManagement'], function () {
        Route::resource( 'user', 'UserController' );
        Route::patch('user/{id}/reset-password', array('as' => 'user.reset-password', 'uses' => 'UserController@resetPassword'));
    });

    // Business
    Route::group(['prefix' => 'business', 'namespace' => 'Business'], function () {
        Route::resource('customer', 'CustomerController');
        Route::post('customer/bulk-delete', array('as' => 'customer.bulk-delete', 'uses' => 'CustomerController@bulkDelete'));
        Route::resource('supplier', 'SupplierController');
        Route::post('supplier/bulk-delete', array('as' => 'supplier.bulk-delete', 'uses' => 'SupplierController@bulkDelete'));
        Route::resource('sales', 'SalesFolderController');
        Route::resource('transaction', 'TransactionController');
        Route::patch('transaction/{id}/approve', array('as' => 'transaction.approve', 'uses' => 'TransactionController@approve'));
        Route::patch('transaction/{id}/reject', array('as' => 'transaction.reject', 'uses' => 'TransactionController@reject'));
        Route::resource('voucher', 'VoucherController');
        Route::resource('lg', 'LGController');
        Route::resource('delivery', 'DeliveryController');

    });

    // Outbound
    Route::group(['prefix' => 'outbound', 'namespace' => 'Outbound'], function () {
        Route::resource('guide', 'GuideController');
        Route::resource('itin', 'ItinController');
    });
});
