<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterLg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_lg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lg_no')->nullable();
            $table->enum('lg_type', ['Yes', 'No']);
            $table->date('lg_date')->nullable();
            $table->enum('delivery_status', ['Complete', 'Incomplete']);
            $table->string('supplier_ref_no')->nullable();
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->integer('credit_term_id')->unsigned()->nullable();
            $table->text('remark')->nullable();
            $table->text('footer')->nullable();
            $table->text('tour_voucher')->nullable();
            $table->float('paid_amt')->nullable()->default(0);
            $table->integer('base_currency_id')->unsigned()->nullable();
            $table->float('base_amt')->nullable()->default(0);
            $table->integer('bill_currency_id')->unsigned()->nullable();
            $table->float('bill_amt')->nullable()->default(0);
            $table->enum('lg_status', ['Active', 'Inactive']);
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('master_lg_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_lg_id')->unsigned();
            $table->string('product_code')->nullable();
            $table->text('product_code_description')->nullable();
            $table->integer('qty')->nullable()->default(0);
            $table->float('unit_cost')->nullable()->default(0);
            $table->float('total_amt')->nullable()->default(0);
            $table->float('discount')->nullable()->default(0);
            $table->float('tax')->nullable()->default(0);
            $table->float('gst_amt')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('master_lg_id')->references('id')->on('master_lg')->onDelete('cascade');
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

        Schema::dropIfExists('master_lg_detail');
        Schema::dropIfExists('master_lg');

        Schema::enableForeignKeyConstraints();
    }
}
