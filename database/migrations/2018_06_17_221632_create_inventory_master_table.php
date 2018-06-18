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
        Schema::create('trx_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_no');
            $table->date('sales_date');
            $table->float('ticket_amt');
            $table->float('rebate');

            $table->timestamps();
            $table->softDeletes();            
        });

        Schema::create('master_inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_sales_id');
            $table->string('inventory_type')->nullable();
            $table->string('voucher_no')->nullable();
            $table->string('product_code')->nullable();
            $table->date('recevied_date')->nullable();
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

            $table->timestamps();
            $table->softDeletes();
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
            $table->string('airlane_pnr')->nullable();
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
        });

        Schema::create('master_inventory_route_hotel', function (Blueprint $table) {
            $table->increments('id')->nullable();
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
        });

        Schema::create('master_inventory_route_car', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->date('from');
            $table->date('to');
            $table->string('company');
            $table->string('class');
            $table->datetime('departure');
            $table->datetime('arrival');
            $table->string('status');

            $table->timestamps();            
        });

        Schema::create('master_inventory_route_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_inventory_id')->unsigned();
            $table->string('cost_type');
            $table->string('lg_no');
            $table->datetime('departure');
            $table->datetime('arrival');
            $table->string('status');

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
        Schema::dropIfExists('master_inventory');
    }
}
