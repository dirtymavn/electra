<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBudgetRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('acc_period_mo')->nullable();
            $table->string('from_currency')->nullable();
            $table->string('to_currency')->nullable();
            $table->float('exchange_rate')->nullable()->default(0);
            $table->boolean('is_draft')->nullable()->default(true);
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();

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
        Schema::dropIfExists('budget_rates');
    }
}
