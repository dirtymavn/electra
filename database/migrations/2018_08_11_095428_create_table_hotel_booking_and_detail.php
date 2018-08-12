<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHotelBookingAndDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('trx_hotel_booking', function (Blueprint $table) {
            $table->increments('id');
            $table->string('booking_number')->nullable();
            $table->integer('id_hotel')->unsigned()->nullable();
            $table->boolean('is_group')->nullable();
            $table->string('tour_code')->nullable();
            $table->integer('id_customer')->unsigned()->nullable();
            $table->boolean('deal_company')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->enum('rate', ['contract', 'special', 'adhoc'])->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->string('booking_status')->nullable();
            $table->text('arrival_detail')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::create('trx_hotel_booking_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_hotel_booking')->unsigned()->nullable();
            $table->string('id_room_type')->unsigned();
            $table->string('id_room_category')->unsigned();
            $table->string('room_number')->nullable();
            $table->string('night')->nullable();
            $table->float('price_per_night', 15, 2)->nullable();
            $table->boolean('include_breakfast')->nullable();
            $table->boolean('non_smooking')->nullable();
            $table->boolean('high_floor')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_hotel_booking')->references('id')->on('trx_hotel_booking')->onDelete('cascade');
        });

        Schema::create('trx_hotel_booking_remark', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_hotel_booking')->unsigned()->nullable();
            $table->text('remark')->nullable();
            $table->text('internal_notes')->nullable();
            $table->text('accounting_notes')->nullable();
            $table->text('cancel_notice')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('tnr_number')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_hotel_booking')->references('id')->on('trx_hotel_booking')->onDelete('cascade');
        });

        Schema::create('trx_hotel_booking_pax', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_hotel_booking')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('pax_name')->nullable();
            $table->enum('type', ['banyak', 'adult', 'child', 'dll'])->nullable();
            $table->integer('id_nationality')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_hotel_booking')->references('id')->on('trx_hotel_booking')->onDelete('cascade');
        });

        Schema::create('trx_hotel_booking_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_hotel_booking')->unsigned()->nullable();
            $table->integer('id_hotel_service')->unsigned()->nullable();
            $table->string('service_code')->nullable();
            $table->string('service_description')->nullable();
            $table->string('quantity')->nullable();
            $table->integer('quantity_order')->nullable();
            $table->date('order_date')->nullable();
            $table->string('total_sales')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_hotel_booking')->references('id')->on('trx_hotel_booking')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('trx_hotel_booking');
        Schema::dropIfExists('trx_hotel_booking_detail');
        Schema::dropIfExists('trx_hotel_booking_remark');
        Schema::dropIfExists('trx_hotel_booking_pax');
        Schema::dropIfExists('trx_hotel_booking_service');

        Schema::enableForeignKeyConstraints();
    }
}
