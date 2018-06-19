<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrxFxTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('trx_fx_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('invoice_flag')->nullable()->default(false);
            $table->boolean('letter_of_guarantee_flag')->nullable()->default(false);
            $table->boolean('credit_note_flag')->nullable()->default(false);
            $table->boolean('deposit_overpayment_flag')->nullable()->default(false);
            $table->boolean('ap_deposit_flag')->nullable()->default(false);
            $table->boolean('cash_account_flag')->nullable()->default(false);
            $table->boolean('bank_account_flag')->nullable()->default(false);
            $table->boolean('other_account_flag')->nullable()->default(false);
            $table->string('jv_period')->nullable();
            $table->string('acc_type')->nullable();
            $table->string('fx_acc')->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('trx_fx_transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_fx_transaction_id');
            $table->string('currency')->nullable();
            $table->float('exchange_rate')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('trx_fx_transaction_id')->references('id')->on('trx_fx_transactions')->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('trx_fx_transaction_details');
        Schema::dropIfExists('trx_fx_transactions');

        Schema::enableForeignKeyConstraints();
    }
}
