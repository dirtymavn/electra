<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSupplierBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::create('master_supplier_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_supplier_id')->unsigned();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('bank_code')->nullable();
            $table->text('remark')->nullable();
            $table->string('country')->nullable();
            
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
        Schema::dropIfExists('master_supplier_bank');
    }
}
