<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterItineraries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_itineraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('itinerary_code')->nullable();
            $table->string('itinerary_direction')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('itinerary_name')->nullable();
            $table->string('airline')->nullable();
            $table->string('category')->nullable();
            $table->string('city_code')->nullable();
            $table->string('type')->nullable();
            $table->string('nationality')->nullable();
            $table->text('description')->nullable();
            $table->integer('min_cap')->nullable();
            $table->integer('max_cap')->nullable();
            $table->date('validity_start')->nullable();
            $table->date('validity_end')->nullable();
            $table->string('departure')->nullable();
            $table->integer('days_duration')->nullable();
            $table->integer('cutoff_days')->nullable();
            $table->text('remark')->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('master_itinerary_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_itinerary_id');
            $table->integer('day')->nullable();
            $table->boolean('as_remark_flag')->nullable()->default(false);
            $table->integer('remark_seq')->nullable();
            $table->string('itinerary_item_code')->nullable();
            $table->string('city')->nullable();
            $table->string('brief_description')->nullable();
            $table->string('land_operator')->nullable();
            $table->text('description')->nullable();
            $table->text('highlight')->nullable();
            $table->string('breakfast')->nullable();
            $table->string('lunch')->nullable();
            $table->string('dinner')->nullable();
            $table->string('accomodations')->nullable();
            $table->text('remark')->nullable();
            $table->text('transport_detail')->nullable();
            $table->boolean('is_temp')->nullable()->default(true);
            $table->timestamps();

            $table->foreign('master_itinerary_id')->references('id')->on('master_itineraries')->onDelete('cascade');
        });

        Schema::create('master_itinerary_optionals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_itinerary_id');
            $table->string('product_description')->nullable();
            $table->string('supplier_no')->nullable();
            $table->string('product_code')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('currency')->nullable();
            $table->float('cost')->nullable()->default(0);
            $table->boolean('is_temp')->nullable()->default(true);
            $table->timestamps();

            $table->foreign('master_itinerary_id')->references('id')->on('master_itineraries')->onDelete('cascade');
        });

        Schema::create('master_itinerary_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_itinerary_id');
            $table->string('product_code')->nullable();
            $table->string('type')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('charge_method')->nullable();
            $table->string('supplier_no')->nullable();
            $table->string('currency')->nullable();
            $table->text('remark')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('tax_currency')->nullable();
            $table->boolean('tax_free_foc_flag')->nullable()->default(false);
            $table->string('foc_discount_type')->nullable();
            $table->boolean('is_temp')->nullable()->default(true);
            $table->timestamps();

            $table->foreign('master_itinerary_id')->references('id')->on('master_itineraries')->onDelete('cascade');
        });

        Schema::create('master_itinerary_service_other_ptcs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_itinerary_service_id');
            $table->string('pax_ptc')->nullable();
            $table->integer('pax_from')->nullable()->default(0);
            $table->integer('pax_to')->nullable()->default(0);
            $table->float('unit_cost')->nullable()->default(0);
            $table->float('discount_percent')->nullable()->default(0);
            $table->float('discount_amount')->nullable()->default(0);
            $table->float('net_cost')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('master_itinerary_service_id')->references('id')->on('master_itinerary_services')->onDelete('cascade');
        });

        Schema::create('master_itinerary_service_focs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_itinerary_service_id');
            $table->integer('pax_no')->nullable()->default(0);
            $table->float('foc')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('master_itinerary_service_id')->references('id')->on('master_itinerary_services')->onDelete('cascade');
        });

        Schema::create('master_itinerary_service_cost_intervals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_itinerary_service_id');
            $table->integer('pax_from')->nullable()->default(0);
            $table->integer('pax_to')->nullable()->default(0);
            $table->float('unit_cost')->nullable()->default(0);
            $table->float('discount_percent')->nullable()->default(0);
            $table->float('discount_amount')->nullable()->default(0);
            $table->float('net_cost')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('master_itinerary_service_id')->references('id')->on('master_itinerary_services')->onDelete('cascade');
        });

        Schema::create('master_itinerary_service_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_itinerary_service_id');
            $table->text('description')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->text('start_description')->nullable();
            $table->text('end_description')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('master_itinerary_service_id')->references('id')->on('master_itinerary_services')->onDelete('cascade');
        });

        Schema::create('master_itinerary_service_taxs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_itinerary_service_id');
            $table->string('ptc')->nullable();
            $table->float('tax_amount')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('master_itinerary_service_id')->references('id')->on('master_itinerary_services')->onDelete('cascade');
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

        Schema::dropIfExists('master_itinerary_service_taxs');
        Schema::dropIfExists('master_itinerary_service_routes');
        Schema::dropIfExists('master_itinerary_service_cost_intervals');
        Schema::dropIfExists('master_itinerary_service_focs');
        Schema::dropIfExists('master_itinerary_service_other_ptcs');
        Schema::dropIfExists('master_itinerary_services');
        Schema::dropIfExists('master_itinerary_optionals');
        Schema::dropIfExists('master_itinerary_details');
        Schema::dropIfExists('master_itineraries');

        Schema::enableForeignKeyConstraints();
    }
}
