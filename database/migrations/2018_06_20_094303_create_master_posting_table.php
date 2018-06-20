<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('trx_posting', function (Blueprint $table) {
            $table->increments('id');
            $table->date('postdate_start');
            $table->date('postdate_end');
            $table->integer('user_id')->unsigned();
            $table->integer('branch_id');
            $table->boolean('is_draft')->nullable()->default(true);

            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('trx_posting_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_posting_id')->unsigned();
            $table->string('transaction_subject');
            $table->string('transaction_type');
            $table->float('in_qty')->nullable()->default(0);
            $table->float('in_price')->nullable()->default(0);
            $table->float('in_total')->nullable()->default(0);
            $table->float('our_qty')->nullable()->default(0);
            $table->float('our_price')->nullable()->default(0);
            $table->float('our_total')->nullable()->default(0);
            $table->float('result_qty')->nullable()->default(0);
            $table->float('result_avg')->nullable()->default(0);
            $table->float('result_total')->nullable()->default(0);

            $table->timestamps();
            $table->foreign('trx_posting_id')->references('id')->on('trx_posting')->onDelete('cascade');
        });

        Schema::create('trx_posting_result', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_id')->nullable();
            $table->string('inventory_code')->nullable();
            $table->float('qty')->nullable();
            $table->float('avg_price')->nullable();

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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('trx_posting_result');
        Schema::dropIfExists('trx_posting_detail');
        Schema::dropIfExists('trx_posting');

        Schema::enableForeignKeyConstraints();
    }
}
