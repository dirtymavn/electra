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

    // User Management
    Route::group(['prefix' => 'user-management', 'namespace' => 'UserManagement'], function () {
        Route::resource( 'user', 'UserController' );
        Route::patch('user/{id}/reset-password', array('as' => 'user.reset-password', 'uses' => 'UserController@resetPassword'));
    });

    Route::group(['prefix' => 'user-management', 'namespace' => 'Master'], function () {
        Route::resource('role', 'RoleController');

    });

     // Business
    Route::group(['prefix' => 'business', 'namespace' => 'Business'], function () {
        Route::resource('sales', 'SalesFolderController');
        Route::resource('delivery', 'DeliveryController');
    });

     // Outbound
    Route::group(['prefix' => 'outbound', 'namespace' => 'Outbound'], function () {

    });

    // Hotel
    Route::group(['prefix' => 'hotel', 'namespace' => 'Hotel'], function () {

    });

    // FIT
    Route::group(['prefix' => 'fit', 'namespace' => 'FIT'], function () {

    });

    // accounting
    Route::group(['prefix' => 'accounting', 'namespace' => 'Accounting'], function () {
        Route::resource('lg', 'LGController');
    });

    // finance
    Route::group(['prefix' => 'finance', 'namespace' => 'Finance'], function () {

    });

    // Master Data
    Route::group(['prefix' => 'master-data', 'namespace' => 'MasterData'], function () {
        Route::resource('customer', 'CustomerController');
        Route::post('customer/bulk-delete', array('as' => 'customer.bulk-delete', 'uses' => 'CustomerController@bulkDelete'));
        Route::resource('supplier', 'SupplierController');
        Route::post('supplier/bulk-delete', array('as' => 'supplier.bulk-delete', 'uses' => 'SupplierController@bulkDelete'));
        Route::resource('voucher', 'VoucherController');
        Route::post('voucher/bulk-delete', array('as' => 'voucher.bulk-delete', 'uses' => 'VoucherController@bulkDelete'));
        // Inventory
        Route::resource('inventory', 'InventoryController');
        Route::post('inventory/bulk-delete', array('as' => 'inventory.bulk-delete', 'uses' => 'InventoryController@bulkDelete'));
        Route::post('inventory/get-detail-data', array('as' => 'inventory.get-detail-data', 'uses' => 'InventoryController@detailData'));
        Route::post('inventory/inventory-detail/delete', array('as' => 'inventory.detail.delete', 'uses' => 'InventoryController@inventoryDetailDelete'));
        Route::post('inventory/inventory-misc-detail', array('as' => 'inventory.misc-detail.post', 'uses' => 'InventoryController@inventoryDetailMisc'));
        Route::post('inventory/inventory-pkg-detail', array('as' => 'inventory.pkg-detail.post', 'uses' => 'InventoryController@inventoryDetailPkg'));
        Route::post('inventory/inventory-detail/detail', array('as' => 'inventory.detail.detail', 'uses' => 'InventoryController@inventoryDetailGetDetail'));
        // end Inventory
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
        // Outbound
        Route::group(['prefix' => 'accounting-setup', 'namespace' => 'Accounting'], function () {

        });
        
    });

     // System
    Route::group(['prefix' => 'system', 'namespace' => 'System'], function () {

    });

    // Audit Trail
    Route::get('audit-trail', array('as' => 'audit-trail.index', 'uses' => 'AuditTrailController@index', 'middleware' => 'sentinel_access:audit-trail'));



    // Master
    // Route::group(['prefix' => 'master', 'namespace' => 'Master'], function () {
    //     Route::resource('company', 'CompanyController')->middleware('sentinel_access:company');
    //     Route::get('export/excel/company', [ 'as' => 'export.company.excel', 'uses' => 'CompanyController@export_excel' ]);
    //     Route::get('export/pdf/company', [ 'as' => 'export.company.pdf', 'uses' => 'CompanyController@export_pdf' ]);
        
    // });
});
