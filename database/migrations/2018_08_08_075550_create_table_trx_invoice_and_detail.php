<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrxInvoiceAndDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('trx_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_no')->nullable();
            $table->integer('sales_id')->unsigned()->nullable();
            $table->char('invoice_status', 100)->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('trip_date')->nullable();
            $table->string('base_currency')->nullable();
            $table->float('base_amt', 15, 2)->nullable();
            $table->string('bill_currency')->nullable();
            $table->float('bill_amt', 15, 2)->nullable();
            $table->float('seattled_amt', 15, 2)->nullable();
            $table->string('fop')->nullable();
            $table->integer('customer_credit_term_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('trx_invoice_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_invoice_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('customer_no')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_attention')->nullable();
            $table->string('customer_gname')->nullable();
            $table->string('customer_title')->nullable();
            $table->string('our_ref')->nullable();
            $table->string('your_ref')->nullable();
            $table->integer('sales_id')->unsigned()->nullable();
            $table->integer('tc_id')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('trx_invoice_id')->references('id')->on('trx_invoice')->onDelete('cascade');
        });

        Schema::create('trx_invoice_refund', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_invoice_id')->unsigned()->nullable();
            $table->integer('ticket_no')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('trx_invoice_id')->references('id')->on('trx_invoice')->onDelete('cascade');
        });

        Schema::create('trx_invoice_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_invoice_id')->unsigned()->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_code_desc')->nullable();
            $table->boolean('pkg_flag')->nullable();
            $table->boolean('suppress_itinerary_flag')->nullable();
            $table->integer('qty')->nullable();
            $table->string('sales_cur')->nullable();
            $table->float('total_sales', 15, 2)->nullable();
            $table->float('total_cost', 15, 2)->nullable();
            $table->float('gp_amt', 15, 2)->nullable();
            $table->float('gp_percentage', 15, 2)->nullable();
            $table->string('pax1')->nullable();
            $table->string('pax2')->nullable();
            $table->float('unit_sales', 15, 2)->nullable();
            $table->float('unit_cost', 15, 2)->nullable();
            $table->float('unit_cost_tax', 15, 2)->nullable();
            $table->float('commission_rate', 15, 2)->nullable();
            $table->float('commission', 15, 2)->nullable();
            $table->float('discount_rate', 15, 2)->nullable();
            $table->float('discount', 15, 2)->nullable();
            $table->float('rebate_rate', 15, 2)->nullable();
            $table->float('rebate', 15, 2)->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('trx_invoice_id')->references('id')->on('trx_invoice')->onDelete('cascade');
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

        Schema::dropIfExists('trx_invoice_customer');
        Schema::dropIfExists('trx_invoice_refund');
        Schema::dropIfExists('trx_invoice_detail');
        Schema::dropIfExists('trx_invoice');

        Schema::enableForeignKeyConstraints();
    }
}
