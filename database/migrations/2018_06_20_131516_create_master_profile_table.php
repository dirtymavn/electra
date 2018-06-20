<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staff_no');
            $table->string('staff_fullname');
            $table->integer('status');
            $table->string('type');
            $table->string('title');
            $table->string('home_tel');
            $table->string('mobile');
            $table->date('employment_date');
            $table->integer('branch_id')->nullable();
            $table->string('office_tel')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('email')->nullable();
            $table->text('office_address')->nullable();
            $table->text('home_address')->nullable();
            $table->text('remark')->nullable();
            $table->string('dr_account')->nullable();
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
        Schema::dropIfExists('master_profile');
    }
}
