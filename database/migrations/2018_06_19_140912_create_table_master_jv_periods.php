<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMasterJvPeriods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_jv_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fiscal_year')->nullable();
            $table->string('period_month')->nullable();
            $table->boolean('period_status')->nullable()->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('report_date')->nullable();
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
        Schema::dropIfExists('master_jv_periods');
    }
}
