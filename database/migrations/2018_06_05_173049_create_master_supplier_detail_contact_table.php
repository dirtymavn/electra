<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSupplierDetailContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_supplier_detail_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_supplier_detail_id')->unsigned();
            $table->string('surname')->nullable();
            $table->string('given_name')->nullable();
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('master_supplier_detail_id')->references('id')->on('master_supplier_detail')->onDelete('cascade');
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
        Schema::dropIfExists('master_supplier_detail_contact');
    }
}
