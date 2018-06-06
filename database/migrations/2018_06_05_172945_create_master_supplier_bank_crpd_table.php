<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSupplierBankCrpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::disableForeignKeyConstraints();

        Schema::create('master_supplier_bank_crpd', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_bank_id')->unsigned();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('ac_no')->nullable();
            $table->string('swift')->nullable();
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
        Schema::dropIfExists('master_supplier_bank_crpd');
    }
}
