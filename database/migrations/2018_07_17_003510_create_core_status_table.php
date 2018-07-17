<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_core_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name');
            $table->string('status_code');
            $table->integer('status_order');
            $table->string('status_approval_flag');
            $table->integer('company_id');
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
        Schema::dropIfExists('master_core_status');
    }
}
