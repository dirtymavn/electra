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
        Route::resource( 'user', 'UserController' )->middleware('sentinel_access:admin,admin.company');
        Route::patch('user/{id}/reset-password', array('as' => 'user.reset-password', 'uses' => 'UserController@resetPassword', 'middleware' => 'sentinel_access:admin,admin.company'));
        Route::resource('role', 'RoleController')->middleware('sentinel_access:admin,admin.company');
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

        // GL
        Route::group(['prefix' => 'gl', 'namespace' => 'GL'], function () {
            // JV Period
            Route::resource('jvperiod', 'JvPeriodController');
            Route::post('jvperiod/bulk-delete', array('as' => 'jvperiod.bulk-delete', 'uses' => 'JvPeriodController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,jvperiod.destroy'));

            // Period End
            Route::resource('periodend', 'TrxPostingController');
            Route::post('periodend/bulk-delete', array('as' => 'periodend.bulk-delete', 'uses' => 'TrxPostingController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,periodend.destroy'));
            Route::post('periodend/get-detail-data', array('as' => 'periodend.get-detail-data', 'uses' => 'TrxPostingController@detailData', 'middleware' => 'sentinel_access:admin.company,periodend.create'));
            Route::post('periodend/trx-detail', array('as' => 'periodend.posting-detail.post', 'uses' => 'TrxPostingController@trxTransDetailStore', 'middleware' => 'sentinel_access:admin.company,periodend.create'));
            Route::post('periodend/trx-detail/delete', array('as' => 'periodend.posting-detail.delete', 'uses' => 'TrxPostingController@trxTransDetailDelete', 'middleware' => 'sentinel_access:admin.company,periodend.create'));
            Route::post('periodend/trx-detail/detail', array('as' => 'periodend.posting-detail.detail', 'uses' => 'TrxPostingController@trxTransDetailGetDetail', 'middleware' => 'sentinel_access:admin.company,periodend.create'));
        });
    });

    // finance
    Route::group(['prefix' => 'finance', 'namespace' => 'Finance'], function () {

    });

    // Master Data
    Route::group(['prefix' => 'master-data', 'namespace' => 'MasterData'], function () {
        Route::resource('customer', 'CustomerController');
        Route::post('customer/bulk-delete', array('as' => 'customer.bulk-delete', 'uses' => 'CustomerController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,customer.destroy'));
        Route::post('customer/get-data', array('as' => 'customer.get-data', 'uses' => 'CustomerController@getData'));
        Route::post('customer/credit-card', array('as' => 'customer.creditcard.post', 'uses' => 'CustomerController@customerCreditCardStore', 'middleware' => 'sentinel_access:admin.company,customer.create'));
        Route::post('customer/data/delete', array('as' => 'customer.data.delete', 'uses' => 'CustomerController@dataDelete', 'middleware' => 'sentinel_access:admin.company,customer.create'));
        Route::post('customer/data/detail', array('as' => 'customer.data.detail', 'uses' => 'CustomerController@dataDetail', 'middleware' => 'sentinel_access:admin.company,customer.create'));

        Route::resource('supplier', 'SupplierController');
        Route::post('supplier/bulk-delete', array('as' => 'supplier.bulk-delete', 'uses' => 'SupplierController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,supplier.destroy'));

        Route::resource('voucher', 'VoucherController');
        Route::post('voucher/bulk-delete', array('as' => 'voucher.bulk-delete', 'uses' => 'VoucherController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,voucher.destroy'));

        // Inventory
        Route::resource('inventory', 'InventoryController');
        Route::post('inventory/bulk-delete', array('as' => 'inventory.bulk-delete', 'uses' => 'InventoryController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,inventory.destroy'));
        Route::post('inventory/get-detail-data', array('as' => 'inventory.get-detail-data', 'uses' => 'InventoryController@detailData', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        Route::post('inventory/inventory-detail/delete', array('as' => 'inventory.detail.delete', 'uses' => 'InventoryController@inventoryDetailDelete', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        Route::post('inventory/inventory-misc-detail', array('as' => 'inventory.misc-detail.post', 'uses' => 'InventoryController@inventoryDetailMisc', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        Route::post('inventory/inventory-pkg-detail', array('as' => 'inventory.pkg-detail.post', 'uses' => 'InventoryController@inventoryDetailPkg', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        Route::post('inventory/inventory-detail/detail', array('as' => 'inventory.detail.detail', 'uses' => 'InventoryController@inventoryDetailGetDetail', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        // end Inventory
        // Outbound
        Route::group(['prefix' => 'outbound', 'namespace' => 'Outbound'], function () {
            Route::resource('guide', 'GuideController');
            Route::post('guide/bulk-delete', array('as' => 'guide.bulk-delete', 'uses' => 'GuideController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,guide.destroy'));
            
            Route::resource('itin', 'ItinController');
            Route::post('itin/bulk-delete', array('as' => 'itin.bulk-delete', 'uses' => 'ItinController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,itin.destroy'));
            Route::post('itin/get-detail-data', array('as' => 'itin.get-detail-data', 'uses' => 'ItinController@detailData'));
            Route::post('itin/itinerary-detail', array('as' => 'itin.itinerary-detail.post', 'uses' => 'ItinController@itineraryDetailStore', 'middleware' => 'sentinel_access:admin.company,itin.create'));
            Route::post('itin/itinerary-detail/delete', array('as' => 'itin.itinerary-detail.delete', 'uses' => 'ItinController@itineraryDetailDelete', 'middleware' => 'sentinel_access:admin.company,itin.create'));
            Route::post('itin/itinerary-detail/detail', array('as' => 'itin.itinerary-detail.detail', 'uses' => 'ItinController@itineraryDetailGetDetail', 'middleware' => 'sentinel_access:admin.company,itin.create'));
            Route::post('itin/itinerary-service', array('as' => 'itin.itinerary-service.post', 'uses' => 'ItinController@itineraryServiceStore', 'middleware' => 'sentinel_access:admin.company,itin.create'));
            
            // related service
            Route::post('itin/itinerary-service-route', array('as' => 'itin.itinerary-service-route.post', 'uses' => 'ItinController@itineraryServiceRouteStore', 'middleware' => 'sentinel_access:admin.company,itin.create'));
            Route::post('itin/itinerary-service-interval', array('as' => 'itin.itinerary-service-interval.post', 'uses' => 'ItinController@itineraryServiceIntervalStore', 'middleware' => 'sentinel_access:admin.company,itin.create'));
            Route::post('itin/itinerary-service-ptc', array('as' => 'itin.itinerary-service-ptc.post', 'uses' => 'ItinController@itineraryServicePtcStore', 'middleware' => 'sentinel_access:admin.company,itin.create'));
            Route::post('itin/itinerary-service-foc', array('as' => 'itin.itinerary-service-foc.post', 'uses' => 'ItinController@itineraryServiceFocStore', 'middleware' => 'sentinel_access:admin.company,itin.create'));
            Route::post('itin/itinerary-service-tax', array('as' => 'itin.itinerary-service-tax.post', 'uses' => 'ItinController@itineraryServiceTaxStore', 'middleware' => 'sentinel_access:admin.company,itin.create'));

            Route::post('itin/itinerary-optional', array('as' => 'itin.itinerary-optional.post', 'uses' => 'ItinController@itineraryOptionalStore', 'middleware' => 'sentinel_access:admin.company,itin.create'));

        }); 

        // Accounting
        Route::group(['prefix' => 'accounting-setup', 'namespace' => 'Accounting'], function () {
            Route::resource('budget-rate', 'BudgetRateController');
            Route::post('budget-rate/bulk-delete', array('as' => 'budget-rate.bulk-delete', 'uses' => 'BudgetRateController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,budget-rate.destroy'));
            Route::resource('account', 'MasterCoaController');
            Route::post('account/bulk-delete', array('as' => 'account.bulk-delete', 'uses' => 'MasterCoaController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,account.destroy'));
            Route::resource('fx-trans', 'FxTransactionController');
            Route::post('fx-trans/bulk-delete', array('as' => 'fx-trans.bulk-delete', 'uses' => 'FxTransactionController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,fx-trans.destroy'));
            Route::post('fx-trans/get-detail-data', array('as' => 'fx-trans.get-detail-data', 'uses' => 'FxTransactionController@detailData', 'middleware' => 'sentinel_access:admin.company,fx-trans.create'));
            Route::post('fx-trans/fx-detail', array('as' => 'fx-trans.fx-detail.post', 'uses' => 'FxTransactionController@fxTransDetailStore', 'middleware' => 'sentinel_access:admin.company,fx-trans.create'));
            Route::post('fx-trans/fx-detail/delete', array('as' => 'fx-trans.fx-detail.delete', 'uses' => 'FxTransactionController@fxTransDetailDelete', 'middleware' => 'sentinel_access:admin.company,fx-trans.create'));
            Route::post('fx-trans/fx-detail/detail', array('as' => 'fx-trans.fx-detail.detail', 'uses' => 'FxTransactionController@fxTransDetailGetDetail', 'middleware' => 'sentinel_access:admin.company,fx-trans.create'));
        });
        
    });

    // System
    Route::group(['prefix' => 'system', 'namespace' => 'System'], function () {
        // Audit Trail
        Route::get('logs', array('as' => 'audit-trail.index', 'uses' => 'AuditTrailController@index', 'middleware' => 'sentinel_access:admin,admin.company'));

        // Company
        Route::resource('company', 'CompanyController')->middleware('sentinel_access:admin');
        Route::get('company/export/excel', ['as' => 'export.company.excel', 'uses' => 'CompanyController@export_excel', 'middleware' => 'sentinel_access:admin']);
        Route::get('company/export/pdf', ['as' => 'export.company.pdf', 'uses' => 'CompanyController@export_pdf', 'middleware' => 'sentinel_access:admin']);

    });



    // Master
    Route::group(['prefix' => 'master', 'namespace' => 'Master'], function () {
        

    });
});
