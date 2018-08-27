<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSoftdeleteTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trx_delivery_order_customers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_delivery_order_despatchs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_delivery_orders', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_delivery_order_customers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_delivery_order_despatchs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_delivery_orders', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_folder', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_folder_detail', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_folder_guide', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_folder_itinerary', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_folder_rate', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_folder_service', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_order_pax_list_tour_accomodations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_order_pax_list_tour_flights', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_order_pax_list_tour_sellings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_order_pax_list_tours', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_order_pax_lists', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_order_tours', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fit_orders', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fx_transaction_details', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_fx_transactions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_hotel_booking', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_hotel_booking_detail', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_hotel_booking_pax', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_hotel_booking_remark', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_hotel_booking_service', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_invoice', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_invoice_customer', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_invoice_detail', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_invoice_refund', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_posting', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_posting_detail', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_posting_result', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_billing', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_credit_card', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_detail', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_detail_cost', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_detail_mis', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_detail_passenger', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_detail_price', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_detail_routing', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_sales_detail_segments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_folder', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_folder_detail', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_folder_guide', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_folder_itinerary', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_folder_rate', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_folder_service', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_order_pax_list_tour_accomodations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_order_pax_list_tour_flights', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_order_pax_list_tour_sellings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_order_pax_list_tours', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_order_pax_lists', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_order_tours', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('trx_tour_orders', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trx_delivery_order_customers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_delivery_order_despatchs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_delivery_orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_delivery_order_customers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_delivery_order_despatchs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_delivery_orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_folder', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_folder_detail', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_folder_guide', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_folder_itinerary', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_folder_rate', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_folder_service', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_order_pax_list_tour_accomodations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_order_pax_list_tour_flights', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_order_pax_list_tour_sellings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_order_pax_list_tours', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_order_pax_lists', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_order_tours', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fit_orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fx_transaction_details', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_fx_transactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_hotel_booking', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_hotel_booking_detail', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_hotel_booking_pax', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_hotel_booking_remark', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_hotel_booking_service', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_invoice', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_invoice_customer', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_invoice_detail', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_invoice_refund', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_posting', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_posting_detail', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_posting_result', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_billing', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_credit_card', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_detail', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_detail_cost', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_detail_mis', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_detail_passenger', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_detail_price', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_detail_routing', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_sales_detail_segments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_folder', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_folder_detail', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_folder_guide', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_folder_itinerary', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_folder_rate', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_folder_service', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_order_pax_list_tour_accomodations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_order_pax_list_tour_flights', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_order_pax_list_tour_sellings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_order_pax_list_tours', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_order_pax_lists', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_order_tours', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('trx_tour_orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

    }
}
