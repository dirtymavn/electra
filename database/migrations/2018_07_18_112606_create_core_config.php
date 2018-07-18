<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('core_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('base_currency_id')->unsigned()->nullable();
            $table->string('base_date')->nullable();
            $table->integer('decimal_number')->nullable()->default(0);
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('core_config_mains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('core_config_id')->unsigned();
            $table->boolean('allow_backdate')->nullable()->default(false);
            $table->integer('backdate_interval')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('core_config_id')->references('id')->on('core_configs')->onDelete('cascade');
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

        Schema::dropIfExists('core_config_mains');
        Schema::dropIfExists('core_configs');

        Schema::enableForeignKeyConstraints();
    }
}
