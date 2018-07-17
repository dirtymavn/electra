<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sales_no');
            $table->integer('customer_id')->unsigned();
            $table->date('trip_date');
            $table->date('deadline')->nullable();
            $table->string('your_ref')->nullable();
            $table->string('our_ref')->nullable();
            $table->integer('tc_id')->nullable();
            $table->integer('invoice_no')->nullable()->unsigned();
            $table->string('sales_date')->nullable();
            $table->float('ticket_amt')->nullable();
            $table->float('rebate')->nullable();
            $table->integer('company_id')->unsigned();
            $table->boolean('is_draft')->nullable()->default(true);

            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('master_customers')->onDelete('cascade');
        });

        Schema::create('trx_sales_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_id')->unsigned();
            $table->integer('product_code')->nullable()->unsigned();
            $table->integer('passenger_class_code')->nullable()->unsigned();
            $table->boolean('is_group_flag')->nullable();
            $table->boolean('is_suppress_flag')->nullable();
            $table->boolean('is_pax_sup')->nullable();
            $table->boolean('is_group_item')->nullable();
            $table->string('pnr_no')->nullable();
            $table->string('dk_no')->nullable();
            $table->string('airline_from')->nullable();
            $table->string('sales_type')->nullable();
            $table->text('sales_detail_remark')->nullable();
            $table->string('confirm_by')->nullable();
            $table->date('confirm_date')->nullable();
            $table->string('mpd_no')->nullable();

            $table->timestamps();

            $table->foreign('trx_sales_id')->references('id')->on('trx_sales')->onDelete('cascade');
        });

        Schema::create('trx_sales_detail_routing', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('trx_sales_detail_id')->unsigned();
             $table->integer('city_from_id')->nullable();
             $table->integer('city_to_id')->nullable();
             $table->integer('airline_id')->nullable();
             $table->integer('passenger_class_id')->nullable();
             $table->datetime('depart_date')->nullable();
             $table->datetime('arrival_date')->nullable();
             $table->integer('stopover_count')->nullable();
             $table->string('stopover_city')->nullable();
             $table->string('airline_pnr')->nullable();
             $table->integer('fly_hr')->nullable();
             $table->string('meal_srv')->nullable();
             $table->string('ssr')->nullable();
             $table->string('sector_pair')->nullable();
             $table->string('path_code')->nullable();
             $table->text('land_sector_desc')->nullable();
             $table->integer('operating_carrier_id')->nullable();
             $table->string('flight_no')->nullable();
             $table->string('flight_status')->nullable();
             $table->string('equip')->nullable();
             $table->string('seat_no')->nullable();
             $table->string('terminal')->nullable();
             $table->integer('mileage')->nullable();
             $table->string('land_sector_flag')->nullable();
             $table->string('stopover')->nullable();
             $table->integer('nuc')->nullable();
             $table->integer('roe')->nullable();

             $table->timestamps();
             $table->foreign('trx_sales_detail_id')->references('id')->on('trx_sales_detail')->onDelete('cascade');
        });

        Schema::create('trx_sales_billing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_id')->unsigned();
            $table->string('ta_no')->nullable();
            $table->integer('cc_id')->nullable();
            $table->string('purpose_code')->nullable();
            $table->string('prcj_no')->nullable();
            $table->string('department')->nullable();
            $table->string('employee_no')->nullable();
            $table->string('account_no')->nullable();
            $table->string('job_title')->nullable();

            $table->timestamps();

            $table->foreign('trx_sales_id')->references('id')->on('trx_sales')->onDelete('cascade');
        });

        Schema::create('trx_sales_credit_card', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_id')->unsigned();
            $table->string('card_type')->nullable();
            $table->string('card_no')->nullable();
            $table->string('cardholder_name')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('security_id')->nullable();
            $table->integer('merchant_no')->nullable();
            $table->string('roc_no')->nullable();
            $table->float('amount')->nullable();
            $table->string('sof_flag')->nullable();
            $table->string('authorisation_code')->nullable();
            $table->date('authorisation_date')->nullable();

            $table->timestamps();

            $table->foreign('trx_sales_id')->references('id')->on('trx_sales')->onDelete('cascade');
        });

        Schema::create('trx_sales_detail_price', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_detail_id')->unsigned();
            $table->text('description')->nullable();
            $table->integer('billing_currency_id')->nullable();
            $table->integer('gst_id')->nullable();
            $table->float('gst_percent')->nullable();
            $table->float('gst_amt')->nullable();
            $table->float('rebate_percent')->nullable();
            $table->float('rebate_amt')->nullable();

            $table->timestamps();

            $table->foreign('trx_sales_detail_id')->references('id')->on('trx_sales_detail')->onDelete('cascade');
        });

        Schema::create('trx_sales_detail_mis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_detail_id')->unsigned();
            $table->string('lowest_fare_rejection')->nullable();
            $table->integer('destination_id')->nullable();
            $table->integer('deal_code')->nullable();
            $table->integer('region_code_id')->nullable();
            $table->string('realised_saving_code')->nullable();
            $table->integer('iata_no')->nullable();
            $table->integer('fare_type_id')->nullable();

            $table->timestamps();

            $table->foreign('trx_sales_detail_id')->references('id')->on('trx_sales_detail')->onDelete('cascade');
        });
        
        Schema::create('trx_sales_detail_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_detail_id')->unsigned();
            $table->float('pay_amt')->nullable();
            $table->integer('currency_code_id')->nullable();
            $table->integer('supplier_reference_id')->nullable();
            $table->integer('voucher_reference_id')->nullable();

            $table->timestamps();

            $table->foreign('trx_sales_detail_id')->references('id')->on('trx_sales_detail')->onDelete('cascade');
        });

        Schema::create('trx_sales_detail_segments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_detail_id')->unsigned();
            $table->text('description')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->text('start_description')->nullable();
            $table->text('end_description')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
            
            $table->foreign('trx_sales_detail_id')->references('id')->on('trx_sales_detail')->onDelete('cascade');
        });

        Schema::create('trx_sales_detail_passenger', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_detail_id')->unsigned();
            $table->string('passenger_name')->nullable();
            $table->text('ticket_no')->nullable();
            $table->text('conj_ticket_no')->nullable();

            $table->timestamps();
        
            $table->foreign('trx_sales_detail_id')->references('id')->on('trx_sales_detail')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_sales_detail_passenger');
        Schema::dropIfExists('trx_sales_detail_segments');
        Schema::dropIfExists('trx_sales_detail_cost');
        Schema::dropIfExists('trx_sales_detail_mis');
        Schema::dropIfExists('trx_sales_credit_card');
        Schema::dropIfExists('trx_sales_detail_price');
        Schema::dropIfExists('trx_sales_detail_routing');
        Schema::dropIfExists('trx_sales_billing');
        Schema::dropIfExists('trx_sales_detail');
        Schema::dropIfExists('trx_sales');
    }
}
