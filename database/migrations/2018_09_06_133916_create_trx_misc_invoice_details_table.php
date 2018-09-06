<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxMiscInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_accounting_misc_invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trx_accounting_misc_invoice_id');
            $table->foreign('trx_accounting_misc_invoice_id')->references('id')->on('trx_accounting_misc_invoices')->onDelete('cascade');;
            $table->unsignedInteger('coa_id');
            $table->unsignedInteger('sales_id');
            $table->string('product_code');
            $table->text('description')->nullable();
            $table->decimal('unit_cost',15,2)->default(0);
            $table->decimal('cost_gst',15,2)->default(0);
            $table->decimal('unit_price',15,2)->default(0);
            $table->integer('qty')->default(0);
            $table->decimal('gst',15,2)->default(0);
            $table->decimal('total_sales',15,2)->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('trx_misc_invoice_details');
    }
}
