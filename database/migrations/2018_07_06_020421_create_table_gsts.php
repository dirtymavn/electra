<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGsts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gsts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gst_code')->nullable();
            $table->float('gst_percent')->nullable();
            $table->boolean('absorb_ppn')->nullable()->default(false);
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
        Schema::dropIfExists('gsts');
    }
}
