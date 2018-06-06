<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSupplierDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_supplier_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_supplier_id')->unisgned();
            $table->string('default_payee')->nullable();
            $table->string('service_provided')->nullable();
            $table->string('gst_registration_no')->nullable();
            $table->integer('gst_id')->nullable();
            $table->string('interface_no')->nullable();
            $table->float('credit_limit')->nullable();
            $table->string('trading_currency')->nullable();
            $table->string('xo_calculated_by')->nullable();
            $table->string('credit_days')->nullable();
            $table->string('credit_term_type')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('master_supplier_id')->references('id')->on('master_supplier')->onDelete('cascade');
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
        Schema::dropIfExists('master_supplier_detail');
    }
}
