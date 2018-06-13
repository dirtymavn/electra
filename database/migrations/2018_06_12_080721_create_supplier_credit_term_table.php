<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierCreditTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_credit_term', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_supplier_id')->unsigned();
            $table->string('term_code');
            $table->string('invoice_due_date_calculation');
            $table->string('credit_days');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('master_supplier_id')->references('id')->on('master_supplier')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_credit_term');
    }
}
