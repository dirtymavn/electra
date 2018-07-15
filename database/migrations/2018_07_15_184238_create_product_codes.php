<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('product_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code')->nullable();
            $table->text('product_name')->nullable();
            $table->text('product_description')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('product_code_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_code_id')->unsigned();
            $table->string('code_type')->nullable();
            $table->boolean('commission_based')->nullable()->default(false);
            $table->boolean('inventory_control')->nullable()->default(false);
            $table->boolean('package_product')->nullable()->default(false);
            $table->boolean('is_domestic')->nullable()->default(false);
            $table->boolean('no_profit_approval')->nullable()->default(false);
            $table->boolean('trx_fee')->nullable()->default(false);
            $table->boolean('misc_invoice')->nullable()->default(false);
            $table->boolean('hotel_conf_advice')->nullable()->default(false);
            $table->boolean('gst_compulsory')->nullable()->default(false);
            $table->boolean('profit_markup')->nullable()->default(false);
            $table->float('profit_markup_amt')->nullable()->default(0);
            $table->timestamps();
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

        Schema::dropIfExists('product_code_types');
        Schema::dropIfExists('product_codes');

        Schema::enableForeignKeyConstraints();
    }
}
