<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->string('category_code');
            $table->boolean('status');
            $table->integer('parent_category_id')->nullable();
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
        Schema::dropIfExists('master_product_categories');
    }
}
