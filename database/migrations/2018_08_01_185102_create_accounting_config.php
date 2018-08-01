<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('accounting_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('core_form_id')->unsigned();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('accounting_config_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accounting_config_id')->unsigned();
            $table->integer('master_coa_id')->nullable();
            $table->string('type')->nullable();
            $table->float('value')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('accounting_config_id')->references('id')->on('accounting_configs')->onDelete('cascade');
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

        Schema::dropIfExists('accounting_config_details');
        Schema::dropIfExists('accounting_configs');

        Schema::enableForeignKeyConstraints();
    }
}
