<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency_name')->nullable();
            $table->string('currency_code')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('currency_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currency_from_id')->nullable();
            $table->integer('currency_to_id')->nullable();
            $table->float('rate')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('currency_from_id')->references('id')->on('currency')->onDelete('cascade');
            $table->foreign('currency_to_id')->references('id')->on('currency')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('currency_rates');
        Schema::dropIfExists('currency');

        Schema::enableForeignKeyConstraints();
    }
}
