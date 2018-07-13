<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_tour', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tour_name');
            $table->string('tour_code');
            $table->date('depart_date');
            $table->date('return_date');
            $table->string('source_type')->nullable();
            $table->string('tour_category')->nullable();
            $table->integer('pax_no')->nullable();
            $table->integer('adult')->nullable();
            $table->integer('child')->nullable();
            $table->integer('infant')->nullable();
            $table->integer('senior')->nullable();
            $table->string('ticket_only')->nullable();
            $table->string('tour_type')->nullable();
            $table->integer('avaliability')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->boolean('is_draft')->nullable()->default(true);

            $table->timestamps();

        });


        Schema::create('trx_tour_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no');
            $table->integer('customer_id');
            $table->string('order_type')->nullable();
            $table->date('trip_date')->nullable();
            $table->date('deadline')->nullable();
            $table->string('your_ref')->nullable();
            $table->string('our_ref')->nullable();
            $table->integer('tc_id')->nullable();

            $table->timestamps();
        });


        Schema::create('trx_tour_order_tour', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_tour_id')->unsigned();
            $table->integer('trx_tour_order_id')->unsigned();
            $table->string('tour_name')->nullable();
            $table->string('tour_code')->nullable();
            $table->date('depart_date')->nullable();
            $table->date('return_date')->nullable();
            $table->integer('days')->nullable();
            $table->string('source_type')->nullable();
            $table->string('tour_category')->nullable();
            $table->integer('pax_no')->nullable();
            $table->integer('adult')->nullable();
            $table->integer('child')->nullable();
            $table->integer('infant')->nullable();
            $table->integer('senior')->nullable();
            $table->string('ticket_only')->nullable();
            $table->string('tour_type')->nullable();

            $table->timestamps();
            $table->foreign('master_tour_id')->references('id')->on('master_tour')->onDelete('cascade');
            $table->foreign('trx_tour_order_id')->references('id')->on('trx_tour_order')->onDelete('cascade');
        });

        Schema::create('trx_tour_order_pax_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_tour_order_id')->unsigned();
            $table->integer('customer_id')->nullable();
            $table->boolean('vip_status_flag')->nullable();
            $table->string('surname')->nullable();
            $table->string('given_name')->nullable();
            $table->string('ptc')->nullable();
            $table->string('title')->nullable();
            $table->string('gender')->nullable();
            $table->string('id_no')->nullable();
            $table->date('dub')->nullable();

            $table->timestamps();
            $table->foreign('trx_tour_order_id')->references('id')->on('trx_tour_order')->onDelete('cascade');
        });

        Schema::create('trx_tour_order_pax_list_tour_accomodation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_tour_order_pax_list_id')->unsigned();
            $table->string('room_type')->nullable();
            $table->string('room_share')->nullable();
            $table->string('room_id')->nullable();
            $table->string('adjoin_room_id')->nullable();

            $table->timestamps();
            $table->foreign('trx_tour_order_pax_list_id')->references('id')->on('trx_tour_order_pax_list')->onDelete('cascade');
        });

        Schema::create('trx_tour_order_pax_list_tour', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_tour_order_pax_list_id')->unsigned();
            $table->string('return_date')->nullable();
            $table->date('deviation')->nullable();
            $table->string('meal')->nullable();
            $table->text('remark')->nullable();
            $table->text('special_req')->nullable();

            $table->timestamps();
            $table->foreign('trx_tour_order_id')->references('id')->on('trx_tour_order_pax_list')->onDelete('cascade');
        });

         Schema::create('trx_tour_order_pax_list_tour_flight', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_tour_order_pax_list_tour_id')->unsigned();
            $table->integer('flight_from')->nullable();
            $table->integer('flight_to')->nullable();
            $table->integer('airline_is')->nullable();
            $table->string('flight_no')->nullable();
            $table->string('class')->nullable();
            $table->text('farebasis')->nullable();
            $table->datetime('depart_date')->nullable();
            $table->datetime('arrived_date')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
            $table->foreign('trx_tour_order_pax_list_tour_id')->references('id')->on('trx_tour_order_pax_list_tour')->onDelete('cascade');
        });

         Schema::create('trx_tour_order_pax_list_tour_selling', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_tour_order_pax_list_tour_id')->unsigned();
            $table->string('price_type')->nullable();
            $table->string('less_total_disc')->nullable();
            $table->string('room_surcharge')->nullable();
            $table->float('tax')->nullable();
            $table->float('rebate')->nullable();
            $table->float('comm')->nullable();
            $table->string('gst')->nullable();
            $table->integer('airline_id')->nullable();
            $table->string('ticket_no')->nullable();
            $table->date('register_date')->nullable();
            $table->string('currency')->nullable();
            $table->float('special_req')->nullable();
            $table->float('remark')->nullable();

            $table->timestamps();
            $table->foreign('trx_tour_order_pax_list_tour_id')->references('id')->on('trx_tour_order_pax_list_tour')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_tour_order_pax_list_tour_selling');
        Schema::dropIfExists('trx_tour_order_pax_list_tour_flight');
        Schema::dropIfExists('trx_tour_order_pax_list_tour_accomodation');
        Schema::dropIfExists('trx_tour_order_pax_list_tour_accomodation');
        Schema::dropIfExists('trx_tour_order_pax_list');
        Schema::dropIfExists('trx_tour_order_tour');
        Schema::dropIfExists('trx_tour_order');
        Schema::dropIfExists('master_tour');
    }
}
