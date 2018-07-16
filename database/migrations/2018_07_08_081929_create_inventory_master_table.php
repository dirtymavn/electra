<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_id')->unsigned();
            $table->string('inventory_type')->nullable();
            $table->string('voucher_no')->nullable();
            $table->string('product_code')->nullable();
            $table->date('received_date')->nullable();
            $table->integer('booked_qty')->nullable();
            $table->integer('sold_qty')->nullable();
            $table->string('status')->nullable();
            $table->integer('qty')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('iata_no')->nullable();
            $table->string('tour_code')->nullable();
            $table->string('coupon_no')->nullable();
            $table->integer('nights')->nullable();
            $table->integer('rooms')->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trx_sales_id')->references('id')->on('trx_sales')->onDelete('cascade');
        });

        Schema::create('master_inventory_route_air', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->string('route_from')->nullable();
            $table->string('route_to')->nullable();
            $table->string('airline_code')->nullable();
            $table->string('flight_no')->nullable();
            $table->string('class')->nullable();
            $table->string('farebasis')->nullable();
            $table->date('depart_date')->nullable();
            $table->datetime('arrival')->nullable();
            $table->datetime('departure')->nullable();
            $table->string('status')->nullable();
            $table->string('equip')->nullable();
            $table->string('stopover_city')->nullable();
            $table->integer('stopover_qty')->nullable();
            $table->string('seat_no')->nullable();
            $table->string('airline_pnr')->nullable();
            $table->time('fly_duration')->nullable();
            $table->string('meal_srv')->nullable();
            $table->string('terminal')->nullable();
            $table->string('ssr')->nullable();
            $table->string('sector_pair')->nullable();
            $table->float('miliage')->nullable();
            $table->string('path_code')->nullable();
            $table->string('land_sector_flag')->nullable();
            $table->text('land_sector_desc')->nullable();

            $table->timestamps();

            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');
        });

        Schema::create('master_inventory_route_hotel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->string('city')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('hotel_chain')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->datetime('checkin_date')->nullable();
            $table->datetime('checkout_date')->nullable();
            $table->string('status')->nullable();
            $table->string('rm_type')->nullable();
            $table->string('rm_cat')->nullable();
            $table->string('guest_prm')->nullable();
            $table->string('meals')->nullable();
            $table->string('other_svc')->nullable();
            $table->string('ref_code')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->string('address')->nullable();
            $table->text('remark')->nullable();

            $table->timestamps();

            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');
        });

        Schema::create('master_inventory_route_car', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('company')->nullable();
            $table->string('class')->nullable();
            $table->datetime('departure')->nullable();
            $table->datetime('arrival')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();  
            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');          
        });

        Schema::create('master_inventory_route_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->string('cost_type')->nullable();
            $table->string('lg_no')->nullable();
            $table->datetime('departure')->nullable();
            $table->datetime('arrival')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();   
            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');         
        });

        Schema::create('master_inventory_transport', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->string('airline_no')->nullable();
            $table->string('reissue')->nullable();
            $table->datetime('valid_from')->nullable();
            $table->datetime('valid_to')->nullable();
            $table->datetime('issue_date')->nullable();
            $table->boolean('conjunction_ticket_flag')->nullable()->default(true);
            $table->boolean('conjunction_firts_ticket')->nullable()->default(true);

            $table->timestamps();   
            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');         
        });

        Schema::create('master_inventory_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->string('cost_type')->nullable();
            $table->string('lg_no')->nullable();
            $table->string('supplier_no')->nullable();
            $table->float('ticket_cost')->nullable();
            $table->float('published_r')->nullable();
            $table->float('exch_rate')->nullable();
            $table->float('tax')->nullable();
            $table->float('discount')->nullable();
            $table->float('comm_amt')->nullable();
            
            $table->timestamps();   
            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');         
        });

        Schema::create('master_inventory_route_misc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->text('description')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->text('start_desc')->nullable();
            $table->text('end_desc')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();   
            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');         
        });

        Schema::create('master_inventory_route_pkg', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->string('package_name')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();   
            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');         
        });

        Schema::create('master_inventory_route_car_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->string('city')->nullable();
            $table->string('company_code')->nullable();
            $table->string('vehicle')->nullable();
            $table->integer('days_hired')->nullable();
            $table->datetime('pickup_date')->nullable();
            $table->string('pickup_location')->nullable();
            $table->datetime('dropoff_date')->nullable();
            $table->string('dropoff_location')->nullable();
            $table->string('status')->nullable();
            $table->string('rate_type')->nullable();

            $table->timestamps(); 
            $table->foreign('master_inventory_id')->references('id')->on('master_inventory')->onDelete('cascade');           
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
            
            Schema::dropIfExists('master_inventory_transport');
            Schema::dropIfExists('master_inventory_route_pkg');
            Schema::dropIfExists('master_inventory_route_misc');
            Schema::dropIfExists('master_inventory_route_cost');
            Schema::dropIfExists('master_inventory_route_car');
            Schema::dropIfExists('master_inventory_route_hotel');
            Schema::dropIfExists('master_inventory_route_air');
            Schema::dropIfExists('master_inventory_route_car_transfer');
            Schema::dropIfExists('master_inventory_cost');
            Schema::dropIfExists('master_inventory');
            
        Schema::enableForeignKeyConstraints();
    }
}
