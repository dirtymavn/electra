<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMasterVisa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_visa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('passport_id')->unsigned()->nullable();
            $table->string('visa_purpose')->nullable();
            $table->string('visa_code')->nullable();
            $table->string('visa_no')->nullable();
            $table->integer('validity')->nullable();
            $table->integer('length_of_stay')->nullable();
            $table->string('no_of_entries')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('selling_currency')->unsigned()->nullable();
            $table->integer('cost_currency')->unsigned()->nullable();
            $table->float('cost', 15, 2)->nullable();
            $table->float('profit', 15, 2)->nullable();
            $table->text('remark')->nullable();
            $table->string('status')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            // $table->foreign('id_hotel')->references('id')->on('master_hotel')->onDelete('cascade');
        });

        Schema::create('master_visa_document', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_visa_id')->unsigned()->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_uri')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('master_visa_id')->references('id')->on('master_visa')->onDelete('cascade');
        });

        Schema::create('master_passport', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_visa_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('nationality')->unsigned()->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('issue_place')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('master_visa_id')->references('id')->on('master_visa')->onDelete('cascade');
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

        Schema::dropIfExists('master_visa');
        Schema::dropIfExists('master_visa_document');
        Schema::dropIfExists('master_passport');

        Schema::enableForeignKeyConstraints();
    }
}
