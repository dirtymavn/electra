<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('region_name')->nullable();
            $table->string('region_code')->nullable();
            $table->text('region_description')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();
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
        Schema::dropIfExists('regions');
    }
}
