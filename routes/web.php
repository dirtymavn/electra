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
        Route::resource('inventory', 'InventoryController');
        Route::post('inventory/bulk-delete', array('as' => 'inventory.bulk-delete', 'uses' => 'InventoryController@bulkDelete'));

    });

    // Outbound
    Route::group(['prefix' => 'outbound', 'namespace' => 'Outbound'], function () {
        Route::resource('guide', 'GuideController');
        Route::post('guide/bulk-delete', array('as' => 'guide.bulk-delete', 'uses' => 'GuideController@bulkDelete'));
        Route::resource('itin', 'ItinController');
        Route::post('itin/bulk-delete', array('as' => 'itin.bulk-delete', 'uses' => 'ItinController@bulkDelete'));
        Route::post('itin/get-detail-data', array('as' => 'itin.get-detail-data', 'uses' => 'ItinController@detailData'));
        Route::post('itin/itinerary-detail', array('as' => 'itin.itinerary-detail.post', 'uses' => 'ItinController@itineraryDetailStore'));
        Route::post('itin/itinerary-detail/delete', array('as' => 'itin.itinerary-detail.delete', 'uses' => 'ItinController@itineraryDetailDelete'));
        Route::post('itin/itinerary-detail/detail', array('as' => 'itin.itinerary-detail.detail', 'uses' => 'ItinController@itineraryDetailGetDetail'));
        Route::post('itin/itinerary-service', array('as' => 'itin.itinerary-service.post', 'uses' => 'ItinController@itineraryServiceStore'));
        Route::post('itin/itinerary-optional', array('as' => 'itin.itinerary-optional.post', 'uses' => 'ItinController@itineraryOptionalStore'));

    });
});
