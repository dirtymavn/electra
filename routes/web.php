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
        Route::get('sales/export/excel', ['as' => 'export.sales.excel', 'uses' => 'SalesFolderController@export_excel']);
        Route::get('sales/export/pdf', ['as' => 'export.sales.pdf', 'uses' => 'SalesFolderController@export_pdf']);
        Route::get('sales/search/data', ['as' => 'sales.search-data', 'uses' => 'SalesFolderController@searchData', 'middleware' => 'sentinel_access:admin.company,sales.create']);
        
        Route::resource('delivery', 'DeliveryController');
        Route::post('delivery/bulk-delete', array('as' => 'delivery.bulk-delete', 'uses' => 'DeliveryController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,delivery.destroy'));
        Route::get('delivery/export/excel', ['as' => 'export.delivery.excel', 'uses' => 'DeliveryController@export_excel']);
        Route::get('delivery/export/pdf', ['as' => 'export.delivery.pdf', 'uses' => 'DeliveryController@export_pdf']);

        // Queue
        Route::resource('businessqueue', 'BusinessQueueController');
        Route::post('businessqueue/bulk-delete', array('as' => 'businessqueue.bulk-delete', 'uses' => 'BusinessQueueController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,businessqueue.destroy'));
        Route::post('businessqueue/get-data', array('as' => 'businessqueue.get-data', 'uses' => 'BusinessQueueController@getData'));
        Route::post('businessqueue/queue-message', array('as' => 'businessqueue.rate.post', 'uses' => 'BusinessQueueController@queueStore', 'middleware' => 'sentinel_access:admin.company,businessqueue.create'));
        Route::post('businessqueue/data/delete', array('as' => 'businessqueue.data.delete', 'uses' => 'BusinessQueueController@dataDelete', 'middleware' => 'sentinel_access:admin.company,businessqueue.create'));
        Route::post('businessqueue/data/detail', array('as' => 'businessqueue.data.detail', 'uses' => 'BusinessQueueController@dataDetail', 'middleware' => 'sentinel_access:admin.company,businessqueue.create'));
        Route::get('businessqueue/export/excel', ['as' => 'export.businessqueue.excel', 'uses' => 'BusinessQueueController@export_excel']);
        Route::get('businessqueue/export/pdf', ['as' => 'export.businessqueue.pdf', 'uses' => 'BusinessQueueController@export_pdf']);


         // invoice
        Route::resource('invoice', 'InvoiceController');
        Route::post('invoice/bulk-delete', array(
                                                    'as' => 'invoice.bulk-delete',
                                                    'uses' => 'InvoiceController@bulkDelete',
                                                    'middleware' => 'sentinel_access:admin.company,invoice.destroy'
                                                ));
        Route::get('invoice/export/excel', ['as' => 'export.invoice.excel', 'uses' => 'InvoiceController@export_excel']);
        Route::get('invoice/export/pdf', ['as' => 'export.invoice.pdf', 'uses' => 'InvoiceController@export_pdf']);
        Route::post('invoice/get-detail-data', array(
                                                        'as' => 'invoice.get-detail-data',
                                                        'uses' => 'InvoiceController@detailData',
                                                        'middleware' => 'sentinel_access:admin.company,invoice.create'
                                                    ));
        Route::post('invoice/invoice-detail/delete', array(
                                                                'as' => 'invoice.detail.delete',
                                                                'uses' => 'InvoiceController@invoiceDetailDelete', 
                                                                'middleware' => 'sentinel_access:admin.company,invoice.create'
                                                            ));
        Route::post('invoice/invoice-detail/detail', array(
                                                                'as' => 'invoice.detail.detail',
                                                                'uses' => 'InvoiceController@invoiceDetailGetDetail',
                                                                'middleware' => 'sentinel_access:admin.company,invoice.create'
                                                            ));
        Route::post('invoice/invoice-detail-detail', array(
                                                            'as' => 'invoice.invoicedetail-detail.post',
                                                            'uses' => 'InvoiceController@invoicePopupInvoicedetail',
                                                            'middleware' => 'sentinel_access:admin.company,invoice.create'
                                                        ));
        Route::post('invoice/invoice-refund-detail', array(
                                                            'as' => 'invoice.invoicerefund-detail.post',
                                                            'uses' => 'InvoiceController@invoicePopupInvoicrefund',
                                                            'middleware' => 'sentinel_access:admin.company,invoice.create'
                                                        ));
        
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

        // detail tour order <get all data>
        Route::get('tourorder/data/get-detail', array('as' => 'tourorder.data.get-detail', 'uses' => 'TourOrderController@detailTourOrder', 'middleware' => 'sentinel_access:admin.company,tourorder.create'));

        // Queue
        Route::resource('outboundqueue', 'OutboundQueueController');
        Route::post('outboundqueue/bulk-delete', array('as' => 'outboundqueue.bulk-delete', 'uses' => 'OutboundQueueController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,outboundqueue.destroy'));
        Route::post('outboundqueue/get-data', array('as' => 'outboundqueue.get-data', 'uses' => 'OutboundQueueController@getData'));
        Route::post('outboundqueue/queue-message', array('as' => 'outboundqueue.rate.post', 'uses' => 'OutboundQueueController@queueStore', 'middleware' => 'sentinel_access:admin.company,outboundqueue.create'));
        Route::post('outboundqueue/data/delete', array('as' => 'outboundqueue.data.delete', 'uses' => 'OutboundQueueController@dataDelete', 'middleware' => 'sentinel_access:admin.company,outboundqueue.create'));
        Route::post('outboundqueue/data/detail', array('as' => 'outboundqueue.data.detail', 'uses' => 'OutboundQueueController@dataDetail', 'middleware' => 'sentinel_access:admin.company,outboundqueue.create'));
        Route::get('outboundqueue/export/excel', ['as' => 'export.outboundqueue.excel', 'uses' => 'OutboundQueueController@export_excel']);
        Route::get('outboundqueue/export/pdf', ['as' => 'export.outboundqueue.pdf', 'uses' => 'OutboundQueueController@export_pdf']);

        Route::get('tourorder/export/excel', ['as' => 'export.tourorder.excel', 'uses' => 'TourOrderController@export_excel']);
        Route::get('tourorder/export/pdf', ['as' => 'export.tourorder.pdf', 'uses' => 'TourOrderController@export_pdf']);



         // tourfolder
        Route::resource('tourfolder', 'TourFolderController');
        Route::post('tourfolder/bulk-delete', array(
                                                    'as' => 'tourfolder.bulk-delete',
                                                    'uses' => 'TourFolderController@bulkDelete',
                                                    'middleware' => 'sentinel_access:admin.company,tourfolder.destroy'
                                                ));
        Route::get('tourfolder/export/excel', ['as' => 'export.tourfolder.excel', 'uses' => 'TourFolderController@export_excel']);
        Route::get('tourfolder/export/pdf', ['as' => 'export.tourfolder.pdf', 'uses' => 'TourFolderController@export_pdf']);
        Route::post('tourfolder/get-detail-data', array(
                                                        'as' => 'tourfolder.get-detail-data',
                                                        'uses' => 'TourFolderController@detailData',
                                                        'middleware' => 'sentinel_access:admin.company,tourfolder.create'
                                                    ));
        Route::post('tourfolder/tourfolder-detail/delete', array(
                                                                'as' => 'tourfolder.detail.delete',
                                                                'uses' => 'TourFolderController@tourfolderDetailDelete', 
                                                                'middleware' => 'sentinel_access:admin.company,tourfolder.create'
                                                            ));
        Route::post('tourfolder/tourfolder-detail/detail', array(
                                                                'as' => 'tourfolder.detail.detail',
                                                                'uses' => 'TourFolderController@tourfolderDetailGetDetail',
                                                                'middleware' => 'sentinel_access:admin.company,tourfolder.create'
                                                            ));
        Route::post('tourfolder/tourfolder-service-detail', array(
                                                            'as' => 'tourfolder.tourfolderservice-detail.post',
                                                            'uses' => 'TourFolderController@tourfolderPopupTourfolderservice',
                                                            'middleware' => 'sentinel_access:admin.company,tourfolder.create'
                                                        ));
        Route::post('tourfolder/tourfolder-itinerary-detail', array(
                                                            'as' => 'tourfolder.tourfolderitinerary-detail.post',
                                                            'uses' => 'TourFolderController@tourfolderPopupTourfolderitinerary',
                                                            'middleware' => 'sentinel_access:admin.company,tourfolder.create'
                                                        ));
        Route::post('tourfolder/tourfolder-rate-detail', array(
                                                            'as' => 'tourfolder.tourfolderrate-detail.post',
                                                            'uses' => 'TourFolderController@tourfolderPopupTourfolderrate',
                                                            'middleware' => 'sentinel_access:admin.company,tourfolder.create'
                                                        ));
        Route::post('tourfolder/tourfolder-guide-detail', array(
                                                            'as' => 'tourfolder.tourfolderguide-detail.post',
                                                            'uses' => 'TourFolderController@tourfolderPopupTourfolderguide',
                                                            'middleware' => 'sentinel_access:admin.company,tourfolder.create'
                                                        ));

        Route::resource('availability', 'AvailabilityController');
        Route::post('availability/bulk-delete', array(
                                                    'as' => 'availability.bulk-delete',
                                                    'uses' => 'AvailabilityController@bulkDelete',
                                                    'middleware' => 'sentinel_access:admin.company,availability.destroy'
                                                ));
        Route::get('availability/export/excel', ['as' => 'export.availability.excel', 'uses' => 'AvailabilityController@export_excel']);
        Route::get('availability/export/pdf', ['as' => 'export.availability.pdf', 'uses' => 'AvailabilityController@export_pdf']);

    });

    // Hotel
    Route::group(['prefix' => 'hotel', 'namespace' => 'Hotel'], function () {
        // Master Hotel booking
        Route::resource('hotel-booking', 'HotelBookingController');
        Route::post('hotel-booking/bulk-delete', array('as' => 'hotel-booking.bulk-delete', 'uses' => 'HotelBookingController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,hotel-booking.destroy'));
        Route::get('hotel-booking/export/excel', ['as' => 'export.hotel-booking.excel', 'uses' => 'HotelBookingController@export_excel']);
        Route::get('hotel-booking/export/pdf', ['as' => 'export.hotel-booking.pdf', 'uses' => 'HotelBookingController@export_pdf']);
        Route::post('hotel-booking/get-detail-data', array(
                                                        'as' => 'hotel-booking.get-detail-data',
                                                        'uses' => 'HotelBookingController@detailData',
                                                        'middleware' => 'sentinel_access:admin.company,hotel-booking.create'
                                                    ));
        Route::post('hotel-booking/hotel-booking-detail/delete', array(
                                                                'as' => 'hotel-booking.detail.delete',
                                                                'uses' => 'HotelBookingController@hotelbookingDetailDelete', 
                                                                'middleware' => 'sentinel_access:admin.company,hotel-booking.create'
                                                            ));
        Route::post('hotel-booking/hotel-booking-detail/detail', array(
                                                                'as' => 'hotel-booking.detail.detail',
                                                                'uses' => 'HotelBookingController@hotelbookingDetailGetDetail',
                                                                'middleware' => 'sentinel_access:admin.company,hotel-booking.create'
                                                            ));
        Route::post('hotel-booking/hotel-booking-detail-detail', array(
                                                            'as' => 'hotel-booking.hotelbookingdetail-detail.post',
                                                            'uses' => 'HotelBookingController@hotelbookingPopupHotelbookingdetail',
                                                            'middleware' => 'sentinel_access:admin.company,hotel-booking.create'
                                                        ));
        Route::post('hotel-booking/hotel-booking-pax-detail', array(
                                                            'as' => 'hotel-booking.hotelbookingpax-detail.post',
                                                            'uses' => 'HotelBookingController@hotelbookingPopupHotelbookingpax',
                                                            'middleware' => 'sentinel_access:admin.company,hotel-booking.create'
                                                        ));
        Route::post('hotel-booking/hotel-booking-service-detail', array(
                                                            'as' => 'hotel-booking.hotelbookingservice-detail.post',
                                                            'uses' => 'HotelBookingController@hotelbookingPopupHotelbookingservice',
                                                            'middleware' => 'sentinel_access:admin.company,hotel-booking.create'
                                                        ));
        
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
        Route::get('customer/export/excel', ['as' => 'export.customer.excel', 'uses' => 'CustomerController@export_excel']);
        Route::get('customer/export/pdf', ['as' => 'export.customer.pdf', 'uses' => 'CustomerController@export_pdf']);

        Route::resource('supplier', 'SupplierController');
        Route::post('supplier/bulk-delete', array('as' => 'supplier.bulk-delete', 'uses' => 'SupplierController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,supplier.destroy'));
        Route::get('supplier/search/data', ['as' => 'supplier.search-data', 'uses' => 'SupplierController@searchData', 'middleware' => 'sentinel_access:admin.company,supplier.create']);
        Route::get('supplier/export/excel', ['as' => 'export.supplier.excel', 'uses' => 'SupplierController@export_excel']);
        Route::get('supplier/export/pdf', ['as' => 'export.supplier.pdf', 'uses' => 'SupplierController@export_pdf']);

        Route::resource('voucher', 'VoucherController');
        Route::post('voucher/bulk-delete', array('as' => 'voucher.bulk-delete', 'uses' => 'VoucherController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,voucher.destroy'));
        Route::get('voucher/export/excel', ['as' => 'export.voucher.excel', 'uses' => 'VoucherController@export_excel']);
        Route::get('voucher/export/pdf', ['as' => 'export.voucher.pdf', 'uses' => 'VoucherController@export_pdf']);

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
        Route::get('inventory/export/excel', ['as' => 'export.inventory.excel', 'uses' => 'InventoryController@export_excel']);
        Route::get('inventory/export/pdf', ['as' => 'export.inventory.pdf', 'uses' => 'InventoryController@export_pdf']);
        Route::get('inventory/search/data', ['as' => 'inventory.search-data', 'uses' => 'InventoryController@searchData', 'middleware' => 'sentinel_access:admin.company,inventory.create']);

        // end Inventory
        // Outbound
        Route::group(['prefix' => 'outbound', 'namespace' => 'Outbound'], function () {
            // Guide
            Route::resource('guide', 'GuideController');
            Route::post('guide/bulk-delete', array('as' => 'guide.bulk-delete', 'uses' => 'GuideController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,guide.destroy'));
            Route::get('guide/export/excel', ['as' => 'export.guide.excel', 'uses' => 'GuideController@export_excel']);
            Route::get('guide/export/pdf', ['as' => 'export.guide.pdf', 'uses' => 'GuideController@export_pdf']);

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
            Route::get('itin/export/excel', ['as' => 'export.itin.excel', 'uses' => 'ItinController@export_excel']);
            Route::get('itin/export/pdf', ['as' => 'export.itin.pdf', 'uses' => 'ItinController@export_pdf']);

        }); 

        // Accounting
        Route::group(['prefix' => 'accounting-setup', 'namespace' => 'Accounting'], function () {
            // Budget Rate
            Route::resource('budget-rate', 'BudgetRateController');
            Route::post('budget-rate/bulk-delete', array('as' => 'budget-rate.bulk-delete', 'uses' => 'BudgetRateController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,budget-rate.destroy'));
            Route::get('budget-rate/export/excel', ['as' => 'export.budget-rate.excel', 'uses' => 'BudgetRateController@export_excel']);
            Route::get('budget-rate/export/pdf', ['as' => 'export.budget-rate.pdf', 'uses' => 'BudgetRateController@export_pdf']);

            // Account
            Route::resource('account', 'MasterCoaController');
            Route::post('account/bulk-delete', array('as' => 'account.bulk-delete', 'uses' => 'MasterCoaController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,account.destroy'));
            Route::get('account/export/excel', ['as' => 'export.account.excel', 'uses' => 'MasterCoaController@export_excel']);
            Route::get('account/export/pdf', ['as' => 'export.account.pdf', 'uses' => 'MasterCoaController@export_pdf']);
            Route::get('account/search/data', ['as' => 'account.search-data', 'uses' => 'MasterCoaController@searchData']);

            // Fx Trans
            Route::resource('fx-trans', 'FxTransactionController');
            Route::post('fx-trans/bulk-delete', array('as' => 'fx-trans.bulk-delete', 'uses' => 'FxTransactionController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,fx-trans.destroy'));
            Route::post('fx-trans/get-detail-data', array('as' => 'fx-trans.get-detail-data', 'uses' => 'FxTransactionController@detailData', 'middleware' => 'sentinel_access:admin.company,fx-trans.create'));
            Route::post('fx-trans/fx-detail', array('as' => 'fx-trans.fx-detail.post', 'uses' => 'FxTransactionController@fxTransDetailStore', 'middleware' => 'sentinel_access:admin.company,fx-trans.create'));
            Route::post('fx-trans/fx-detail/delete', array('as' => 'fx-trans.fx-detail.delete', 'uses' => 'FxTransactionController@fxTransDetailDelete', 'middleware' => 'sentinel_access:admin.company,fx-trans.create'));
            Route::post('fx-trans/fx-detail/detail', array('as' => 'fx-trans.fx-detail.detail', 'uses' => 'FxTransactionController@fxTransDetailGetDetail', 'middleware' => 'sentinel_access:admin.company,fx-trans.create'));
            Route::get('fx-trans/export/excel', ['as' => 'export.fx-trans.excel', 'uses' => 'FxTransactionController@export_excel']);
            Route::get('fx-trans/export/pdf', ['as' => 'export.fx-trans.pdf', 'uses' => 'FxTransactionController@export_pdf']);
        });

        // Passenger Class
        Route::resource('passenger', 'PassengerClassController');
        Route::post('passenger/bulk-delete', array('as' => 'passenger.bulk-delete', 'uses' => 'PassengerClassController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,passenger.destroy'));
        Route::get('passenger/export/excel', ['as' => 'export.passenger.excel', 'uses' => 'PassengerClassController@export_excel']);
        Route::get('passenger/export/pdf', ['as' => 'export.passenger.pdf', 'uses' => 'PassengerClassController@export_pdf']);
        // Airline
        Route::resource('airline', 'AirlineController');
        Route::post('airline/bulk-delete', array('as' => 'airline.bulk-delete', 'uses' => 'AirlineController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,airline.destroy'));
        Route::get('airline/search/data', ['as' => 'airline.search-data', 'uses' => 'AirlineController@searchData', 'middleware' => 'sentinel_access:admin.company,airline.create']);
        Route::get('airline/get/data', ['as' => 'airline.get-data-by-id', 'uses' => 'AirlineController@getAirlineById', 'middleware' => 'sentinel_access:admin.company,airline.create']);
        Route::get('airline/export/excel', ['as' => 'export.airline.excel', 'uses' => 'AirlineController@export_excel']);
        Route::get('airline/export/pdf', ['as' => 'export.airline.pdf', 'uses' => 'AirlineController@export_pdf']);

        // Product Type
        Route::resource('product-type', 'ProductTypeController');
        Route::post('product-type/bulk-delete', array('as' => 'product-type.bulk-delete', 'uses' => 'ProductTypeController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,product-type.destroy'));
        Route::get('product-type/export/excel', ['as' => 'export.product-type.excel', 'uses' => 'ProductTypeController@export_excel']);
        Route::get('product-type/export/pdf', ['as' => 'export.product-type.pdf', 'uses' => 'ProductTypeController@export_pdf']);

        // Inventory Type
        Route::resource('inventory-type', 'InventoryTypeController');
        Route::post('inventory-type/bulk-delete', array('as' => 'inventory-type.bulk-delete', 'uses' => 'InventoryTypeController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,inventory-type.destroy'));
        Route::get('inventory-type/export/excel', ['as' => 'export.inventory-type.excel', 'uses' => 'InventoryTypeController@export_excel']);
        Route::get('inventory-type/export/pdf', ['as' => 'export.inventory-type.pdf', 'uses' => 'InventoryTypeController@export_pdf']);
        

        // Product Category
        Route::resource('product-category', 'ProductCategoryController');
        Route::post('product-category/bulk-delete', array('as' => 'product-category.bulk-delete', 'uses' => 'ProductCategoryController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,product-category.destroy'));
        Route::get('product-category/export/excel', ['as' => 'export.product-category.excel', 'uses' => 'ProductCategoryController@export_excel']);
        Route::get('product-category/export/pdf', ['as' => 'export.product-category.pdf', 'uses' => 'ProductCategoryController@export_pdf']);

        // Region
        Route::resource('region', 'RegionController');
        Route::post('region/bulk-delete', array('as' => 'region.bulk-delete', 'uses' => 'RegionController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,region.destroy'));
        Route::get('region/export/excel', ['as' => 'export.region.excel', 'uses' => 'RegionController@export_excel']);
        Route::get('region/export/pdf', ['as' => 'export.region.pdf', 'uses' => 'RegionController@export_pdf']);

        // Gst
        Route::resource('gst', 'GstController');
        Route::post('gst/bulk-delete', array('as' => 'gst.bulk-delete', 'uses' => 'GstController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,gst.destroy'));
        Route::get('gst/export/excel', ['as' => 'export.gst.excel', 'uses' => 'GstController@export_excel']);
        Route::get('gst/export/pdf', ['as' => 'export.gst.pdf', 'uses' => 'GstController@export_pdf']);

        // Currency Rate
        Route::resource('currencyrate', 'CurrencyController');
        Route::post('currencyrate/bulk-delete', array('as' => 'currencyrate.bulk-delete', 'uses' => 'CurrencyController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,currencyrate.destroy'));
        Route::post('currencyrate/get-data', array('as' => 'currencyrate.get-data', 'uses' => 'CurrencyController@getData'));
        Route::post('currencyrate/credit-card', array('as' => 'currencyrate.rate.post', 'uses' => 'CurrencyController@currencyrateStore', 'middleware' => 'sentinel_access:admin.company,currencyrate.create'));
        Route::post('currencyrate/data/delete', array('as' => 'currencyrate.data.delete', 'uses' => 'CurrencyController@dataDelete', 'middleware' => 'sentinel_access:admin.company,currencyrate.create'));
        Route::post('currencyrate/data/detail', array('as' => 'currencyrate.data.detail', 'uses' => 'CurrencyController@dataDetail', 'middleware' => 'sentinel_access:admin.company,currencyrate.create'));
        Route::get('currencyrate/search/data', ['as' => 'currencyrate.search-data', 'uses' => 'CurrencyController@searchData', 'middleware' => 'sentinel_access:admin.company,currencyrate.create']);
        Route::get('currencyrate/search/data-by-code', ['as' => 'currencyrate.search-data-by-code', 'uses' => 'CurrencyController@searchDataByCode', 'middleware' => 'sentinel_access:admin.company,currencyrate.create']);
        Route::get('currencyrate/export/excel', ['as' => 'export.currencyrate.excel', 'uses' => 'CurrencyController@export_excel']);
        Route::get('currencyrate/export/pdf', ['as' => 'export.currencyrate.pdf', 'uses' => 'CurrencyController@export_pdf']);

        // Country
        Route::resource('country', 'CountryController');
        Route::post('country/bulk-delete', array('as' => 'country.bulk-delete', 'uses' => 'CountryController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,country.destroy'));
        Route::get('country/search/data', ['as' => 'country.search-data', 'uses' => 'CountryController@searchData', 'middleware' => 'sentinel_access:admin.company,country.create']);
        Route::get('country/search/data-nationality', ['as' => 'country.search-data-nationality', 'uses' => 'CountryController@searchDataNationality', 'middleware' => 'sentinel_access:admin.company,country.create']);
        Route::get('country/export/excel', ['as' => 'export.country.excel', 'uses' => 'CountryController@export_excel']);
        Route::get('country/export/pdf', ['as' => 'export.country.pdf', 'uses' => 'CountryController@export_pdf']);

        // City
        Route::resource('city', 'CityController');
        Route::post('city/bulk-delete', array('as' => 'city.bulk-delete', 'uses' => 'CityController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,city.destroy'));
        Route::get('city/search/data', ['as' => 'city.search-data', 'uses' => 'CityController@searchData', 'middleware' => 'sentinel_access:admin.company,city.create']);
        Route::get('city/search/byCountry', ['as' => 'city.search-data-by-country', 'uses' => 'CityController@searchByCountry', 'middleware' => 'sentinel_access:admin.company,city.create']);
        Route::get('city/search/data-normal', ['as' => 'city.search-data-normal', 'uses' => 'CityController@searchDataNormal', 'middleware' => 'sentinel_access:admin.company,city.create']);
        Route::get('city/export/excel', ['as' => 'export.city.excel', 'uses' => 'CityController@export_excel']);
        Route::get('city/export/pdf', ['as' => 'export.city.pdf', 'uses' => 'CityController@export_pdf']);

        // Airport
        Route::resource('airport', 'AirportController');
        Route::post('airport/bulk-delete', array('as' => 'airport.bulk-delete', 'uses' => 'AirportController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,airport.destroy'));
        Route::get('airport/export/excel', ['as' => 'export.airport.excel', 'uses' => 'AirportController@export_excel']);
        Route::get('airport/export/pdf', ['as' => 'export.airport.pdf', 'uses' => 'AirportController@export_pdf']);
        Route::get('airport/search/data', ['as' => 'airport.search-data', 'uses' => 'AirportController@searchData', 'middleware' => 'sentinel_access:admin.company,airport.create']);

        // Tour
        Route::resource('tour', 'TourController');
        Route::post('tour/bulk-delete', array('as' => 'tour.bulk-delete', 'uses' => 'TourController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,tour.destroy'));
        Route::get('tour/search/data', ['as' => 'tour.search-data', 'uses' => 'TourController@searchData', 'middleware' => 'sentinel_access:admin.company,tour.create']);
        Route::get('tour/export/excel', ['as' => 'export.tour.excel', 'uses' => 'TourController@export_excel']);
        Route::get('tour/export/pdf', ['as' => 'export.tour.pdf', 'uses' => 'TourController@export_pdf']);

        // Do Type
        Route::resource('dotype', 'DoTypeController');
        Route::post('dotype/bulk-delete', array('as' => 'dotype.bulk-delete', 'uses' => 'DoTypeController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,dotype.destroy'));
        Route::get('dotype/export/excel', ['as' => 'export.dotype.excel', 'uses' => 'DoTypeController@export_excel']);
        Route::get('dotype/export/pdf', ['as' => 'export.dotype.pdf', 'uses' => 'DoTypeController@export_pdf']);

        // Product Code
        Route::resource('productcode', 'ProductCodeController');
        Route::post('productcode/bulk-delete', array('as' => 'productcode.bulk-delete', 'uses' => 'ProductCodeController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,productcode.destroy'));
        Route::post('productcode/get-data', array('as' => 'productcode.get-data', 'uses' => 'ProductCodeController@getData'));
        Route::post('productcode/credit-card', array('as' => 'productcode.rate.post', 'uses' => 'ProductCodeController@productCodeDetailStore', 'middleware' => 'sentinel_access:admin.company,productcode.create'));
        Route::post('productcode/data/delete', array('as' => 'productcode.data.delete', 'uses' => 'ProductCodeController@dataDelete', 'middleware' => 'sentinel_access:admin.company,productcode.create'));
        Route::post('productcode/data/detail', array('as' => 'productcode.data.detail', 'uses' => 'ProductCodeController@dataDetail', 'middleware' => 'sentinel_access:admin.company,productcode.create'));
        Route::get('productcode/export/excel', ['as' => 'export.productcode.excel', 'uses' => 'ProductCodeController@export_excel']);
        Route::get('productcode/export/pdf', ['as' => 'export.productcode.pdf', 'uses' => 'ProductCodeController@export_pdf']);

         // Master Document
        Route::resource('document', 'MasterDocumentController');
        Route::post('document/bulk-delete', array('as' => 'document.bulk-delete', 'uses' => 'MasterDocumentController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,document.destroy'));
        Route::post('document/get-data', array('as' => 'document.get-data', 'uses' => 'MasterDocumentController@getData'));
        Route::post('document/queue-message', array('as' => 'document.rate.post', 'uses' => 'MasterDocumentController@documentStore', 'middleware' => 'sentinel_access:admin.company,document.create'));
        Route::post('document/data/delete', array('as' => 'document.data.delete', 'uses' => 'MasterDocumentController@dataDelete', 'middleware' => 'sentinel_access:admin.company,document.create'));
        Route::post('document/data/detail', array('as' => 'document.data.detail', 'uses' => 'MasterDocumentController@dataDetail', 'middleware' => 'sentinel_access:admin.company,document.create'));
        Route::get('document/export/excel', ['as' => 'export.document.excel', 'uses' => 'MasterDocumentController@export_excel']);
        Route::get('document/export/pdf', ['as' => 'export.document.pdf', 'uses' => 'MasterDocumentController@export_pdf']);

        // Branch
        Route::resource('branch', 'CompanyBranchController');
        Route::post('branch/bulk-delete', array('as' => 'branch.bulk-delete', 'uses' => 'CompanyBranchController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,branch.destroy'));
        Route::get('branch/search/data', ['as' => 'branch.search-data', 'uses' => 'CompanyBranchController@searchData']);
        Route::get('branch/export/excel', ['as' => 'export.branch.excel', 'uses' => 'CompanyBranchController@export_excel']);
        Route::get('branch/export/pdf', ['as' => 'export.branch.pdf', 'uses' => 'CompanyBranchController@export_pdf']);

        // Department
        Route::resource('department', 'CompanyDepartmentController');
        Route::post('department/bulk-delete', array('as' => 'department.bulk-delete', 'uses' => 'CompanyDepartmentController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,department.destroy'));
        Route::get('department/search/data', ['as' => 'department.search-data', 'uses' => 'CompanyDepartmentController@searchData']);
        Route::get('department/export/excel', ['as' => 'export.department.excel', 'uses' => 'CompanyDepartmentController@export_excel']);
        Route::get('department/export/pdf', ['as' => 'export.department.pdf', 'uses' => 'CompanyDepartmentController@export_pdf']);

        // Master Hotel Chain
        Route::resource('hotel-chain', 'HotelChainController');
        Route::post('hotel-chain/bulk-delete', array('as' => 'hotel-chain.bulk-delete', 'uses' => 'HotelChainController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,hotel-chain.destroy'));
        Route::get('hotel-chain/export/excel', ['as' => 'export.hotel-chain.excel', 'uses' => 'HotelChainController@export_excel']);
        Route::get('hotel-chain/export/pdf', ['as' => 'export.hotel-chain.pdf', 'uses' => 'HotelChainController@export_pdf']);

         // Master Hotel
        Route::resource('master-hotel', 'MasterHotelController');
        Route::post('master-hotel/bulk-delete', array(
                                                    'as' => 'master-hotel.bulk-delete',
                                                    'uses' => 'MasterHotelController@bulkDelete',
                                                    'middleware' => 'sentinel_access:admin.company,master-hotel.destroy'
                                                ));
        Route::get('master-hotel/export/excel', ['as' => 'export.master-hotel.excel', 'uses' => 'MasterHotelController@export_excel']);
        Route::get('master-hotel/export/pdf', ['as' => 'export.master-hotel.pdf', 'uses' => 'MasterHotelController@export_pdf']);
        Route::post('master-hotel/get-detail-data', array(
                                                        'as' => 'master-hotel.get-detail-data',
                                                        'uses' => 'MasterHotelController@detailData',
                                                        'middleware' => 'sentinel_access:admin.company,master-hotel.create'
                                                    ));
        Route::post('master-hotel/master-hotel-detail/delete', array(
                                                                'as' => 'master-hotel.detail.delete',
                                                                'uses' => 'MasterHotelController@masterhotelDetailDelete', 
                                                                'middleware' => 'sentinel_access:admin.company,master-hotel.create'
                                                            ));
        Route::post('master-hotel/master-hotel-detail/detail', array(
                                                                'as' => 'master-hotel.detail.detail',
                                                                'uses' => 'MasterHotelController@masterhotelDetailGetDetail',
                                                                'middleware' => 'sentinel_access:admin.company,master-hotel.create'
                                                            ));
        Route::post('master-hotel/master-hotel-contact-detail', array(
                                                            'as' => 'master-hotel.hotel-contact-detail.post',
                                                            'uses' => 'MasterHotelController@masterhotelDetailHotelContact',
                                                            'middleware' => 'sentinel_access:admin.company,master-hotel.create'
                                                        ));
        Route::post('master-hotel/master-hotel-service-detail', array(
                                                            'as' => 'master-hotel.hotel-service-detail.post',
                                                            'uses' => 'MasterHotelController@masterhotelDetailHotelService',
                                                            'middleware' => 'sentinel_access:admin.company,master-hotel.create'
                                                        ));


         // Master Hotel allotment
        Route::resource('hotel-allotment', 'HotelAllotmentController');
        Route::post('hotel-allotment/bulk-delete', array(
                                                    'as' => 'hotel-allotment.bulk-delete',
                                                    'uses' => 'HotelAllotmentController@bulkDelete',
                                                    'middleware' => 'sentinel_access:admin.company,hotel-allotment.destroy'
                                                ));
        Route::get('hotel-allotment/export/excel', ['as' => 'export.hotel-allotment.excel', 'uses' => 'HotelAllotmentController@export_excel']);
        Route::get('hotel-allotment/export/pdf', ['as' => 'export.hotel-allotment.pdf', 'uses' => 'HotelAllotmentController@export_pdf']);
        Route::post('hotel-allotment/get-detail-data', array(
                                                        'as' => 'hotel-allotment.get-detail-data',
                                                        'uses' => 'HotelAllotmentController@detailData',
                                                        'middleware' => 'sentinel_access:admin.company,hotel-allotment.create'
                                                    ));
        Route::post('hotel-allotment/hotel-allotment-detail/delete', array(
                                                                'as' => 'hotel-allotment.detail.delete',
                                                                'uses' => 'HotelAllotmentController@hotelallotmentDetailDelete', 
                                                                'middleware' => 'sentinel_access:admin.company,hotel-allotment.create'
                                                            ));
        Route::post('hotel-allotment/hotel-allotment-detail/detail', array(
                                                                'as' => 'hotel-allotment.detail.detail',
                                                                'uses' => 'HotelAllotmentController@hotelallotmentDetailGetDetail',
                                                                'middleware' => 'sentinel_access:admin.company,hotel-allotment.create'
                                                            ));
        Route::post('hotel-allotment/hotel-allotment-allotmentdetail-detail', array(
                                                            'as' => 'hotel-allotment.hotel-allotmentdetail-detail.post',
                                                            'uses' => 'HotelAllotmentController@hotelallotmantDetailHotelAllotmentdetail',
                                                            'middleware' => 'sentinel_access:admin.company,hotel-allotment.create'
                                                        ));
        // Master air-allotment
        Route::resource('air-allotment', 'AirAllotmentController');
        Route::post('air-allotment/bulk-delete', array('as' => 'air-allotment.bulk-delete', 'uses' => 'AirAllotmentController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,air-allotment.destroy'));
        Route::get('air-allotment/export/excel', ['as' => 'export.air-allotment.excel', 'uses' => 'AirAllotmentController@export_excel']);
        Route::get('air-allotment/export/pdf', ['as' => 'export.air-allotment.pdf', 'uses' => 'AirAllotmentController@export_pdf']);


        // Master Credit Card
        Route::resource('credit-card', 'CreditCardController');
        Route::post('credit-card/bulk-delete', array('as' => 'credit-card.bulk-delete', 'uses' => 'CreditCardController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,credit-card.destroy'));
        Route::get('credit-card/export/excel', ['as' => 'export.credit-card.excel', 'uses' => 'CreditCardController@export_excel']);
        Route::get('credit-card/export/pdf', ['as' => 'export.credit-card.pdf', 'uses' => 'CreditCardController@export_pdf']);

        // Master Visa
        Route::resource('visa', 'VisaController');
        Route::post('visa/bulk-delete', array('as' => 'visa.bulk-delete', 'uses' => 'VisaController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,visa.destroy'));
        Route::get('visa/export/excel', ['as' => 'export.visa.excel', 'uses' => 'VisaController@export_excel']);
        Route::get('visa/export/pdf', ['as' => 'export.visa.pdf', 'uses' => 'VisaController@export_pdf']);
        Route::post('visa/get-detail-data', array(
                                                        'as' => 'visa.get-detail-data',
                                                        'uses' => 'VisaController@detailData',
                                                        'middleware' => 'sentinel_access:admin.company,visa.create'
                                                    ));
        Route::post('visa/visa-detail/delete', array(
                                                                'as' => 'visa.detail.delete',
                                                                'uses' => 'VisaController@visaDetailDelete', 
                                                                'middleware' => 'sentinel_access:admin.company,visa.create'
                                                            ));
        Route::post('visa/visa-detail/detail', array(
                                                                'as' => 'visa.detail.detail',
                                                                'uses' => 'VisaController@visaDetailGetDetail',
                                                                'middleware' => 'sentinel_access:admin.company,visa.create'
                                                            ));
        Route::post('visa/visa-document-detail', array(
                                                            'as' => 'visa.visadocument-detail.post',
                                                            'uses' => 'VisaController@visaPopupVisadocument',
                                                            'middleware' => 'sentinel_access:admin.company,visa.create'
                                                        ));
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
        Route::get('core-status/export/excel', ['as' => 'export.core-status.excel', 'uses' => 'CoreStatusController@export_excel']);
        Route::get('core-status/export/pdf', ['as' => 'export.core-status.pdf', 'uses' => 'CoreStatusController@export_pdf']);

        // Core Config
        Route::resource('core-config', 'CoreConfigController');
        Route::post('core-config/bulk-delete', array('as' => 'core-config.bulk-delete', 'uses' => 'CoreConfigController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,core-config.destroy'));
        Route::get('core-config/export/excel', ['as' => 'export.core-config.excel', 'uses' => 'CoreConfigController@export_excel']);
        Route::get('core-config/export/pdf', ['as' => 'export.core-config.pdf', 'uses' => 'CoreConfigController@export_pdf']);

        // Core Module
        Route::resource('core', 'CoreController');
        Route::post('core/bulk-delete', array('as' => 'core.bulk-delete', 'uses' => 'CoreController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,core.destroy'));

    });

    // Setting
    Route::group(['prefix' => 'setting', 'namespace' => 'Setting'], function () {
        // Core Form
        Route::get('core-form', array('as' => 'core-form.index', 'uses' => 'CoreFormController@index', 'middleware' => 'sentinel_access:admin,admin.company'));
        Route::get('core-form/search/data', ['as' => 'core-form.search-data', 'uses' => 'CoreFormController@searchData']);

        // Accounting Config
        Route::resource('accounting-config', 'AccountingConfigController');
        Route::post('accounting-config/bulk-delete', array('as' => 'accounting-config.bulk-delete', 'uses' => 'AccountingConfigController@bulkDelete', 'middleware' => 'sentinel_access:admin.company,accounting-config.destroy'));
    });
    // Finance
    Route::group(['prefix' => 'finance', 'namespace' => 'Finance'], function () {
        
    });
});
