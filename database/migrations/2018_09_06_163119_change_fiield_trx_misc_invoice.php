<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFiieldTrxMiscInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trx_accounting_misc_invoices', function (Blueprint $table) {
            $table->integer('sales_id')->unsigned()->nullable()->change();
            $table->integer('tc_id')->unsigned()->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trx_accounting_misc_invoices', function (Blueprint $table) {
            $table->integer('sales_id')->unsigned()->change();
            $table->integer('tc_id')->unsigned()->change();
        });
    }
}
