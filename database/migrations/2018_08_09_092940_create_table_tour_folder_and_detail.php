<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTourFolderAndDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('trx_tour_folder', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tour_code')->nullable();
            $table->string('tour_name')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('status')->nullable();
            $table->enum('direction', ['inbound', 'outbound'])->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('trx_tour_folder_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tour_folder')->unsigned()->nullable();
            $table->enum('tour_category', ['local', 'asia', 'europe'])->nullable();
            $table->enum('tour_type', ['shopping', 'elderly', 'ski'])->nullable();
            $table->integer('id_airlines')->unsigned()->nullable();
            $table->string('description')->nullable();
            $table->integer('min_capacity')->unsigned()->nullable();
            $table->integer('max_capacity')->unsigned()->nullable();
            $table->integer('number_of_days')->unsigned()->nullable();
            $table->date('cut_of_date')->nullable();
            $table->date('ticket_dateline')->nullable();
            $table->date('deposit_dateline')->nullable();
            $table->integer('id_currency')->unsigned()->nullable();
            $table->integer('origin')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_tour_folder')->references('id')->on('trx_tour_folder')->onDelete('cascade');
        });

        Schema::create('trx_tour_folder_itinerary', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tour_folder')->unsigned()->nullable();
            $table->integer('day')->unsigned()->nullable();
            $table->string('itinerary_code')->nullable();
            $table->integer('city')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->integer('operator')->unsigned()->nullable();
            $table->string('breakfast')->nullable();
            $table->string('lunch')->nullable();
            $table->string('dinner')->nullable();
            $table->string('accomodation')->nullable();
            $table->text('notes')->nullable();
            $table->text('transport_detail')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_tour_folder')->references('id')->on('trx_tour_folder')->onDelete('cascade');
        });

        Schema::create('trx_tour_folder_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tour_folder')->unsigned()->nullable();
            $table->integer('id_product')->unsigned()->nullable();
            $table->enum('service_type', ['ticket', 'land'])->nullable();
            $table->enum('charge_method', ['per group', 'per pax'])->nullable();
            $table->integer('id_currency')->unsigned()->nullable();
            $table->integer('id_supplier')->unsigned()->nullable();
            $table->text('notes')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_tour_folder')->references('id')->on('trx_tour_folder')->onDelete('cascade');
        });

        Schema::create('trx_tour_folder_rate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tour_folder')->unsigned()->nullable();
            $table->enum('customer_type', ['fit', 'agent', 'commercial'])->nullable();
            $table->enum('price_type', ['normal tour', 'ticket only', 'land only'])->nullable();
            $table->integer('group_size')->unsigned()->nullable();
            $table->float('price', 15, 2)->nullable();
            $table->float('discount', 15, 2)->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_tour_folder')->references('id')->on('trx_tour_folder')->onDelete('cascade');
        });

        Schema::create('trx_tour_folder_guide', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tour_folder')->unsigned()->nullable();
            $table->integer('id_tour_guide')->unsigned()->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->text('guide_number')->nullable();
            $table->text('title')->nullable();
            $table->text('name')->nullable();
            $table->text('notes')->nullable();
            $table->text('cash_advance')->nullable();
            $table->text('cash_return')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_tour_folder')->references('id')->on('trx_tour_folder')->onDelete('cascade');
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

        Schema::dropIfExists('trx_tour_folder');
        Schema::dropIfExists('trx_tour_folder_detail');
        Schema::dropIfExists('trx_tour_folder_itinerary');
        Schema::dropIfExists('trx_tour_folder_service');
        Schema::dropIfExists('trx_tour_folder_rate');
        Schema::dropIfExists('trx_tour_folder_guide');

        Schema::enableForeignKeyConstraints();
    }
}
