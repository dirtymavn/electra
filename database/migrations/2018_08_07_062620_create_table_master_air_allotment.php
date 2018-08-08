<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMasterAirAllotment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_air_allotment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pnr', 255)->nullable();
            $table->integer('id_airport_from')->unsigned()->nullable();
            $table->integer('id_ariport_to')->unsigned()->nullable();
            $table->integer('id_airlines')->unsigned()->nullable();
            $table->string('flight_number', 255)->nullable();
            $table->string('class', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->date('departure_date')->nullable();
            $table->date('arrival_date')->nullable();
            $table->integer('allotment')->nullable();
            $table->text('reserve')->nullable();
            $table->text('sold')->nullable();
            $table->text('available')->nullable();
            $table->text('reserve_tour')->nullable();

            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
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
        Schema::dropIfExists('master_air_allotment');
    }
}
