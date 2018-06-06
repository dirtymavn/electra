<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSupplierBankDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_supplier_bank_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_bank_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('acc_no_1')->nullable();
            $table->string('acc_no_1_currency')->nullable();
            $table->string('iban_1')->nullable();
            $table->string('acc_no_2')->nullable();
            $table->string('acc_no_2_currency')->nullable();
            $table->string('iban_2')->nullable();
            $table->string('acc_no_3')->nullable();
            $table->string('acc_no_3_currency')->nullable();
            $table->string('iban_3')->nullable();
            $table->string('acc_no_4')->nullable();
            $table->string('acc_no_4_currency')->nullable();
            $table->string('iban_4')->nullable();
            $table->string('swift')->nullable();
            $table->string('bic')->nullable();
            $table->text('remark')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('supplier_bank_id')->references('id')->on('master_supplier_bank')->onDelete('cascade');
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
        Schema::dropIfExists('master_supplier_bank_detail');
    }
}
