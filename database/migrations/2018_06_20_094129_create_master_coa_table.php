<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterCoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_coa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('acc_no_key')->nullable();
            $table->string('acc_no_interface')->nullable();
            $table->text('acc_description')->nullable();
            $table->integer('sub_acc_id')->nullable();
            $table->string('acc_type')->nullable();
            $table->string('rollup_key_acc_no')->nullable();
            $table->integer('acc_liquidity')->nullable();
            $table->string('rollup_detail')->nullable();
            $table->string('analysis_type')->nullable();
            $table->boolean('foregin_currency_only_flag')->default(false);
            $table->boolean('ap_ar_control_flag')->default(false);
            $table->boolean('tour_account_flag')->default(false);
            $table->boolean('fx_adjusment_flag')->default(false);
            $table->boolean('inter_branch_acc_flag')->default(false);
            $table->boolean('internal_payment_flag')->default(false);
            $table->boolean('is_draft')->nullable()->default(true);

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
        Schema::dropIfExists('master_coa');
    }
}
