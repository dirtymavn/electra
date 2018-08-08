<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCreditCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_credit_card', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 16);
            $table->date('expire_date');
            $table->string('name', 30);
            $table->text('address')->nullable();
            $table->string('state', 20)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('cvv', 3)->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
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
        Schema::dropIfExists('master_credit_card');
    }
}
