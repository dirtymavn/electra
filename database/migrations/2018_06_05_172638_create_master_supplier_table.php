<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_no');
            $table->string('supplier_type');
            $table->string('name');
            $table->text('address');
            $table->enum('status', ['active', 'disable'] )->nullable();
            $table->boolean('hotel_vendor_flag', [true, false] )->nullable();
            $table->boolean('sundry_profile_flag', [true, false] )->nullable();
            $table->boolean('is_draft')->nullable()->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_supplier');
    }
}
