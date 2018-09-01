<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccountingMiscInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('trx_accounting_misc_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->integer('invoice_status')->default(0);
            $table->integer('misc_invoice_type')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('sales_id')->unsigned();
            $table->integer('tc_id')->unsigned();
            $table->string('base_currency')->nullable();
            $table->string('billing_currency')->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('trx_accounting_misc_invoices');
        Schema::enableForeignKeyConstraints();
    }
}
