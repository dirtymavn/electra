<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMasterHotelAllotment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_hotel_allotment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address_info', 255)->nullable();
            $table->string('name_info', 200)->nullable();
            $table->string('all_contact_person_info', 255)->nullable();
            $table->integer('id_hotel')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();

            $table->softDeletes();
            $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::create('master_hotel_allotment_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_hotel_room_type', 255)->nullable();
            $table->date('date')->nullable();
            $table->integer('available_room_smooking')->nullable();
            $table->integer('available_room_non_smooking')->nullable();
            $table->integer('id_hotel_allotment')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();

            $table->softDeletes();
            $table->foreign('id_hotel_allotment')->references('id')->on('master_hotel_allotment')->onDelete('cascade');
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

        Schema::dropIfExists('master_hotel_allotment');
        Schema::dropIfExists('master_hotel_allotment_detail');

        Schema::enableForeignKeyConstraints();
    }
}
