<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_module', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module_name');       
            $table->string('module_label');       
            $table->string('module_code');       
            $table->integer('company_id')->nullable()->unsigned();    
            $table->boolean('is_draft')->nullable()->default(true);    
            $table->timestamps();
        });

        Schema::create('core_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('core_module_id')->unsigned();       
            $table->string('report_name')->nullable();       
            $table->string('report_url')->nullable();       
            $table->string('report_label')->nullable();       
            $table->string('report_code')->nullable();       

            $table->timestamps();
        });

        Schema::create('core_form', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('core_module_id')->unsigned();       
            $table->string('form_name')->nullable();      
            $table->string('form_url')->nullable();      
            $table->string('form_label')->nullable();      
            $table->string('form_code')->nullable();      
            $table->boolean('printable_output')->nullable();      

            $table->timestamps();
        });


        Schema::create('core_from_chain', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('core_from_id')->unsigned();       
            $table->integer('chain_before')->nullable();       
            $table->integer('chain_after')->nullable();       

            $table->timestamps();
        });

        Schema::create('master_company_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_company_id')->unsigned();       
            $table->integer('core_module_id')->unsigned();       
            $table->string('module_label')->nullable();            
            $table->string('module_code')->nullable();            

            $table->timestamps();
        });

        Schema::create('master_company_form', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_company_id')->unsigned();       
            $table->integer('form_id')->unsigned();       
            $table->string('form_label')->nullable();            
            $table->string('form_code')->nullable();            

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
        Schema::dropIfExists('master_company_form');
        Schema::dropIfExists('master_company_modules');
        Schema::dropIfExists('core_from_chain');
        Schema::dropIfExists('core_form');
        Schema::dropIfExists('core_report');
        Schema::dropIfExists('core_module');
    }
}
