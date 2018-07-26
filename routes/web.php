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
        Route::get('role/search/data', ['as' => 'role.search-data', 'uses' => 'RoleController@searchData']);
    });

     // Business
    Route::group(['prefix' => 'business', 'namespace' => 'Business'], function () {
        Route::resource('sales', 'SalesFolderController');
        Route::post('sales/bulk-delete', array('as' => 'sales.bulk-delete', 'uses' => 'SalesFolderController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,sales.destroy'));
        Route::post('sales/get-detail-data', array('as' => 'sales.get-detail-data', 'uses' => 'SalesFolderController@detailData', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        Route::post('sales/sales-detail/delete', array('as' => 'sales.detail.delete', 'uses' => 'SalesFolderController@salesDetailDelete', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        Route::post('sales/sales-detail/detail', array('as' => 'sales.detail.detail', 'uses' => 'SalesFolderController@salesDetailGetDetail', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        Route::post('sales/sales-sales-detail', array('as' => 'sales.sales-detail.post', 'uses' => 'SalesFolderController@salesDetail', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        Route::post('sales/sales-routing-detail', array('as' => 'sales.routing-detail.post', 'uses' => 'SalesFolderController@salesRouting', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        Route::post('sales/sales-mis-detail', array('as' => 'sales.mis-detail.post', 'uses' => 'SalesFolderController@salesMis', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        Route::post('sales/sales-cost-detail', array('as' => 'sales.cost-detail.post', 'uses' => 'SalesFolderController@salesCost', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        Route::post('sales/sales-price-detail', array('as' => 'sales.price-detail.post', 'uses' => 'SalesFolderController@salesPrice', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        Route::post('sales/sales-segment-detail', array('as' => 'sales.segment-detail.post', 'uses' => 'SalesFolderController@salesSegment', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        Route::post('sales/sales-passenger-detail', array('as' => 'sales.passenger-detail.post', 'uses' => 'SalesFolderController@salesPassenger', 'middleware' => 'sentinel_access:admin.company,sales.create'));
        
        Route::resource('delivery', 'DeliveryController');
        Route::post('delivery/bulk-delete', array('as' => 'delivery.bulk-delete', 'uses' => 'DeliveryController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,delivery.destroy'));
    });

     // Outbound
    Route::group(['prefix' => 'outbound', 'namespace' => 'Outbound'], function () {
        // Tour Order
        Route::resource('tourorder', 'TourOrderController');
        Route::post('tourorder/bulk-delete', array('as' => 'tourorder.bulk-delete', 'uses' => 'TourOrderController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,tourorder.destroy'));
        Route::post('tourorder/get-data', array('as' => 'tourorder.get-data', 'uses' => 'TourOrderController@getData'));
        Route::post('tourorder/data/delete', array('as' => 'tourorder.data.delete', 'uses' => 'TourOrderController@dataDelete', 'middleware' => 'sentinel_access:admin.company,tourorder.create'));
        Route::post('tourorder/data/detail', array('as' => 'tourorder.data.detail', 'uses' => 'TourOrderController@dataDetail', 'middleware' => 'sentinel_access:admin.company,tourorder.create'));
        // Tour Order Paxlist
        Route::post('tourorder/paxlist', array('as' => 'tourorder.paxlist.post', 'uses' => 'TourOrderController@tourOrderPaxlistStore', 'middleware' => 'sentinel_access:admin.company,tourorder.create'));

        //Tour Order Paxlist Flight
        Route::post('tourorder/paxlist-flight', array('as' => 'tourorder.paxlist-flight.post', 'uses' => 'TourOrderController@tourOrderPaxlistFlightStore', 'middleware' => 'sentinel_access:admin.company,tourorder.create'));
    });

    // Hotel
    Route::group(['prefix' => 'hotel', 'namespace' => 'Hotel'], function () {

    });

    // FIT
    Route::group(['prefix' => 'fit', 'namespace' => 'FIT'], function () {

    });

    // accounting
    Route::group(['prefix' => 'accounting', 'namespace' => 'Accounting'], function () {
        // LG
        Route::resource('lg', 'LGController');
        Route::post('lg/bulk-delete', array('as' => 'lg.bulk-delete', 'uses' => 'LGController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,lg.destroy'));
        Route::post('lg/get-data', array('as' => 'lg.get-data', 'uses' => 'LGController@getData'));
        Route::post('lg/credit-card', array('as' => 'lg.detail.post', 'uses' => 'LGController@lgDetailStore', 'middleware' => 'sentinel_access:admin.company,lg.create'));
        Route::post('lg/data/delete', array('as' => 'lg.data.delete', 'uses' => 'LGController@dataDelete', 'middleware' => 'sentinel_access:admin.company,lg.create'));
        Route::post('lg/data/detail', array('as' => 'lg.data.detail', 'uses' => 'LGController@dataDetail', 'middleware' => 'sentinel_access:admin.company,lg.create'));

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
        Route::get('customer/search/data', ['as' => 'customer.search-data', 'uses' => 'CustomerController@searchData', 'middleware' => 'sentinel_access:admin.company,customer.create']);
        Route::get('customer/get/data', ['as' => 'customer.get-data-by-id', 'uses' => 'CustomerController@getCustomerById', 'middleware' => 'sentinel_access:admin.company,customer.create']);

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
        Route::post('inventory/inventory-car-detail', array('as' => 'inventory.car-detail.post', 'uses' => 'InventoryController@inventoryDetailCar', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        Route::post('inventory/inventory-car-transfer-detail', array('as' => 'inventory.car-transfer-detail.post', 'uses' => 'InventoryController@inventoryCarTransfer', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        Route::post('inventory/inventory-air-detail', array('as' => 'inventory.air-detail.post', 'uses' => 'InventoryController@inventoryRouteAir', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
        Route::post('inventory/inventory-hotel-detail', array('as' => 'inventory.hotel-detail.post', 'uses' => 'InventoryController@inventoryRouteHotel', 'middleware' => 'sentinel_access:admin.company,inventory.create'));
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

        // Passenger Class
        Route::resource('passenger', 'PassengerClassController');
        Route::post('passenger/bulk-delete', array('as' => 'passenger.bulk-delete', 'uses' => 'PassengerClassController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,passenger.destroy'));
        
        // Airline
        Route::resource('airline', 'AirlineController');
        Route::post('airline/bulk-delete', array('as' => 'airline.bulk-delete', 'uses' => 'AirlineController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,airline.destroy'));
        Route::get('airline/search/data', ['as' => 'airline.search-data', 'uses' => 'AirlineController@searchData', 'middleware' => 'sentinel_access:admin.company,airline.create']);
        Route::get('airline/get/data', ['as' => 'airline.get-data-by-id', 'uses' => 'AirlineController@getAirlineById', 'middleware' => 'sentinel_access:admin.company,airline.create']);

        // Product Type
        Route::resource('product-type', 'ProductTypeController');
        Route::post('product-type/bulk-delete', array('as' => 'product-type.bulk-delete', 'uses' => 'ProductTypeController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,product-type.destroy'));

        // Product Category
        Route::resource('product-category', 'ProductCategoryController');
        Route::post('product-category/bulk-delete', array('as' => 'product-category.bulk-delete', 'uses' => 'ProductCategoryController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,product-category.destroy'));

        // Region
        Route::resource('region', 'RegionController');
        Route::post('region/bulk-delete', array('as' => 'region.bulk-delete', 'uses' => 'RegionController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,region.destroy'));

        // Gst
        Route::resource('gst', 'GstController');
        Route::post('gst/bulk-delete', array('as' => 'gst.bulk-delete', 'uses' => 'GstController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,gst.destroy'));

        // Currency Rate
        Route::resource('currencyrate', 'CurrencyController');
        Route::post('currencyrate/bulk-delete', array('as' => 'currencyrate.bulk-delete', 'uses' => 'CurrencyController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,currencyrate.destroy'));
        Route::post('currencyrate/get-data', array('as' => 'currencyrate.get-data', 'uses' => 'CurrencyController@getData'));
        Route::post('currencyrate/credit-card', array('as' => 'currencyrate.rate.post', 'uses' => 'CurrencyController@currencyrateStore', 'middleware' => 'sentinel_access:admin.company,currencyrate.create'));
        Route::post('currencyrate/data/delete', array('as' => 'currencyrate.data.delete', 'uses' => 'CurrencyController@dataDelete', 'middleware' => 'sentinel_access:admin.company,currencyrate.create'));
        Route::post('currencyrate/data/detail', array('as' => 'currencyrate.data.detail', 'uses' => 'CurrencyController@dataDetail', 'middleware' => 'sentinel_access:admin.company,currencyrate.create'));
        Route::get('currencyrate/search/data', ['as' => 'currencyrate.search-data', 'uses' => 'CurrencyController@searchData', 'middleware' => 'sentinel_access:admin.company,currencyrate.create']);

        // Country
        Route::resource('country', 'CountryController');
        Route::post('country/bulk-delete', array('as' => 'country.bulk-delete', 'uses' => 'CountryController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,country.destroy'));
        Route::get('country/search/data', ['as' => 'country.search-data', 'uses' => 'CountryController@searchData', 'middleware' => 'sentinel_access:admin.company,country.create']);

        // City
        Route::resource('city', 'CityController');
        Route::post('city/bulk-delete', array('as' => 'city.bulk-delete', 'uses' => 'CityController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,city.destroy'));
        Route::get('city/search/data', ['as' => 'city.search-data', 'uses' => 'CityController@searchData', 'middleware' => 'sentinel_access:admin.company,city.create']);
        Route::get('city/search/byCountry', ['as' => 'city.search-data-by-country', 'uses' => 'CityController@searchByCountry', 'middleware' => 'sentinel_access:admin.company,city.create']);

        // Airport
        Route::resource('airport', 'AirportController');
        Route::post('airport/bulk-delete', array('as' => 'airport.bulk-delete', 'uses' => 'AirportController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,airport.destroy'));

        // Tour
        Route::resource('tour', 'TourController');
        Route::post('tour/bulk-delete', array('as' => 'tour.bulk-delete', 'uses' => 'TourController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,tour.destroy'));
        Route::get('tour/search/data', ['as' => 'tour.search-data', 'uses' => 'TourController@searchData', 'middleware' => 'sentinel_access:admin.company,tour.create']);

        // Do Type
        Route::resource('dotype', 'DoTypeController');
        Route::post('dotype/bulk-delete', array('as' => 'dotype.bulk-delete', 'uses' => 'DoTypeController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,dotype.destroy'));
        // Product Code
        Route::resource('productcode', 'ProductCodeController');
        Route::post('productcode/bulk-delete', array('as' => 'productcode.bulk-delete', 'uses' => 'ProductCodeController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,productcode.destroy'));
        Route::post('productcode/get-data', array('as' => 'productcode.get-data', 'uses' => 'ProductCodeController@getData'));
        Route::post('productcode/credit-card', array('as' => 'productcode.rate.post', 'uses' => 'ProductCodeController@productCodeDetailStore', 'middleware' => 'sentinel_access:admin.company,productcode.create'));
        Route::post('productcode/data/delete', array('as' => 'productcode.data.delete', 'uses' => 'ProductCodeController@dataDelete', 'middleware' => 'sentinel_access:admin.company,productcode.create'));
        Route::post('productcode/data/detail', array('as' => 'productcode.data.detail', 'uses' => 'ProductCodeController@dataDetail', 'middleware' => 'sentinel_access:admin.company,productcode.create'));

         // Master Document
        Route::resource('document', 'MasterDocumentController');
        Route::post('document/bulk-delete', array('as' => 'document.bulk-delete', 'uses' => 'MasterDocumentController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,document.destroy'));
        Route::post('document/get-data', array('as' => 'document.get-data', 'uses' => 'MasterDocumentController@getData'));
        Route::post('document/credit-card', array('as' => 'document.rate.post', 'uses' => 'MasterDocumentController@documentStore', 'middleware' => 'sentinel_access:admin.company,document.create'));
        Route::post('document/data/delete', array('as' => 'document.data.delete', 'uses' => 'MasterDocumentController@dataDelete', 'middleware' => 'sentinel_access:admin.company,document.create'));
        Route::post('document/data/detail', array('as' => 'document.data.detail', 'uses' => 'MasterDocumentController@dataDetail', 'middleware' => 'sentinel_access:admin.company,document.create'));

        // Branch
        Route::resource('branch', 'CompanyBranchController');
        Route::post('branch/bulk-delete', array('as' => 'branch.bulk-delete', 'uses' => 'CompanyBranchController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,branch.destroy'));
        Route::get('branch/search/data', ['as' => 'branch.search-data', 'uses' => 'CompanyBranchController@searchData']);

        // Department
        Route::resource('department', 'CompanyDepartmentController');
        Route::post('department/bulk-delete', array('as' => 'department.bulk-delete', 'uses' => 'CompanyDepartmentController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,department.destroy'));
        Route::get('department/search/data', ['as' => 'department.search-data', 'uses' => 'CompanyDepartmentController@searchData']);
    });

    // System
    Route::group(['prefix' => 'system', 'namespace' => 'System'], function () {
        // Audit Trail
        Route::get('logs', array('as' => 'audit-trail.index', 'uses' => 'AuditTrailController@index', 'middleware' => 'sentinel_access:admin,admin.company'));

        // Company
        Route::resource('company', 'CompanyController')->middleware('sentinel_access:admin');
        Route::get('company/export/excel', ['as' => 'export.company.excel', 'uses' => 'CompanyController@export_excel', 'middleware' => 'sentinel_access:admin']);
        Route::get('company/export/pdf', ['as' => 'export.company.pdf', 'uses' => 'CompanyController@export_pdf', 'middleware' => 'sentinel_access:admin']);
        Route::get('company/search/data', ['as' => 'company.search-data', 'uses' => 'CompanyController@searchData']);

        // Core Status
        Route::resource('core-status', 'CoreStatusController');
        Route::post('core-status/bulk-delete', array('as' => 'core-status.bulk-delete', 'uses' => 'CoreStatusController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,core-status.destroy'));

        // Core Config
        Route::resource('core-config', 'CoreConfigController');
        Route::post('core-config/bulk-delete', array('as' => 'core-config.bulk-delete', 'uses' => 'CoreConfigController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,core-config.destroy'));

    });



    // Finance
    Route::group(['prefix' => 'finance', 'namespace' => 'Finance'], function () {
        
    });
});
