<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_voucher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_no')->nullable();
            $table->string('voucher_status')->nullable();
            $table->datetime('voucher_date')->nullable();
            $table->string('voucher_currency')->nullable();
            $table->float('voucher_amt')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->string('transferrable_flag')->nullable();
            $table->text('internal_desc')->nullable();
            $table->text('desc')->nullable();
            $table->string('cust_no')->nullable();
            $table->string('cust_name')->nullable();
            $table->text('cust_address')->nullable();
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
        Schema::dropIfExists('master_voucher');
    }
}
