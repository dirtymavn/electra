<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableMasterHotel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        /*DROP COLUM*/
        Schema::table('master_hotel_property', function (Blueprint $table) {
            $table->dropColumn(['non_smooking_room', 'number_of_meeting_room', 'max_capacity', 'property_type']);
        });
        Schema::table('master_hotel_finance', function (Blueprint $table) {
            $table->dropColumn(['deposit_type', 'payment_type', 'credit_limit', 'credit_terms', 'currency_1', 'currency_2']);
        });
        Schema::table('master_hotel_others', function (Blueprint $table) {
            $table->dropColumn(['max_cancellation_days_group', 'max_cancellation_days_fit', 'minimum_stay', 'maximum_stay', 'cancellation_charge']);
        });
        Schema::table('master_hotel_service', function (Blueprint $table) {
            $table->dropColumn(['season', 'cost', 'sales', 'start_date', 'end_date', 'is_free']);
        });

        /*MODIFIED*/
        Schema::table('master_hotel_contact', function (Blueprint $table) {
            $table->softDeletes();
            $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::table('master_hotel_property', function (Blueprint $table) {
            $table->boolean('non_smooking_room')->nullable();
            $table->integer('number_of_meeting_room')->nullable();
            $table->integer('max_capacity')->nullable();
            $table->integer('property_type')->nullable();
           
            $table->softDeletes();
            $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::table('master_hotel_finance', function (Blueprint $table) {
            $table->enum('deposit_type', ['tt', 'bank draft', 'credit', 'others'])->nullable();
            $table->enum('payment_type', ['tt', 'bank draft', 'credit', 'others'])->nullable();
            $table->float('credit_limit', 15, 2)->nullable();
            $table->integer('credit_terms')->nullable();
            $table->integer('currency_1')->unsigned()->nullable();
            $table->integer('currency_2')->unsigned()->nullable();

            $table->softDeletes();
            $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::table('master_hotel_others', function (Blueprint $table) {
            $table->integer('max_cancellation_days_group')->nullable();
            $table->integer('max_cancellation_days_fit')->nullable();
            $table->integer('minimum_stay')->nullable();
            $table->integer('maximum_stay')->nullable();
            $table->float('cancellation_charge', 15, 2)->nullable();

            $table->softDeletes();
            $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::table('master_hotel_service', function (Blueprint $table) {
            $table->enum('season', ['low season', 'shoulder season', 'high season'])->nullable();
            $table->float('cost', 15, 2)->nullable();
            $table->float('sales', 15, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_free')->nullable()->default(true);

            $table->softDeletes();
            $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::table('master_hotel_rooms_type', function (Blueprint $table) {
            $table->softDeletes();
            $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::disableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
