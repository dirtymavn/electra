<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMasterHotelAndDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('master_hotel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->text('address')->nullable();
            $table->integer('id_city')->unsigned()->nullable();
            $table->integer('id_country')->unsigned()->nullable();
            $table->integer('id_hotel_chain')->unsigned()->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('phone_2', 30)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('fax_2', 50)->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('master_hotel_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('email', 255)->nullable();
            $table->integer('id_hotel')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('master_hotel_property', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_capacity', 250)->nullable();
            $table->string('suite_number', 250)->nullable();
            $table->string('number_of_floors', 250)->nullable();
            $table->boolean('non_smooking_room');
            $table->integer('number_of_meeting_room');
            $table->integer('max_capacity');
            $table->integer('property_type');
            $table->integer('id_hotel')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('master_hotel_finance', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('deposit_type', ['tt', 'bank draft', 'credit', 'others']);
            $table->enum('payment_type', ['tt', 'bank draft', 'credit', 'others']);
            $table->float('credit_limit', 15, 2);
            $table->string('id_credit_limit_currency', 255)->nullable();
            $table->integer('credit_terms');
            $table->string('bank_name_1', 255)->nullable();
            $table->string('bank_account_1', 255)->nullable();
            $table->integer('currency_1');
            $table->string('bank_name_2', 255)->nullable();
            $table->string('bank_account_2', 255)->nullable();
            $table->integer('currency_2');
            $table->integer('id_hotel')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('master_hotel_others', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('max_cancellation_days_group');
            $table->integer('max_cancellation_days_fit');
            $table->integer('minimum_stay');
            $table->integer('maximum_stay');
            $table->float('cancellation_charge', 15, 2);
            $table->integer('id_hotel')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('master_hotel_service', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_name', 255)->nullable();
            $table->text('service_desciption')->nullable();
            $table->float('cost', 15, 2);
            $table->float('sales', 15, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('season', ['low season', 'shoulder season', 'high season']);
            $table->boolean('is_free');
            $table->integer('id_hotel')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('master_hotel_rooms_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_type', 255)->nullable();
            $table->string('room_description', 255)->nullable();
            $table->string('bed_type', 255)->nullable();
            $table->integer('id_hotel')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
            
            Schema::dropIfExists('master_hotel_contact');
            Schema::dropIfExists('master_hotel_property');
            Schema::dropIfExists('master_hotel_finance');
            Schema::dropIfExists('master_hotel_others');
            Schema::dropIfExists('master_hotel_service');
            Schema::dropIfExists('master_hotel_rooms_type');
            Schema::dropIfExists('master_hotel');
            
        Schema::enableForeignKeyConstraints();
    }
}
