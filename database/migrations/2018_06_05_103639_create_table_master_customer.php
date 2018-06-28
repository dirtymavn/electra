<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMasterCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('master_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_no')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('company_id')->nullable();
            $table->enum('status', ['active', 'non_active'])->nullable();
            $table->enum('salutation', ['yes', 'no'])->nullable();
            $table->integer('sales_id')->nullable();
            $table->integer('customer_group_id')->nullable();
            $table->boolean('is_draft')->nullable()->default(true);
            $table->timestamps();
        });

        Schema::create('master_customer_mains', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->integer('servicing_branch_id')->nullable();
            $table->integer('rpt_group_id')->nullable();
            $table->enum('cust_type_id', ['yes', 'no'])->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('billing_address')->nullable();
            $table->enum('office_address', ['yes', 'no'])->nullable();
            $table->text('travel_policy')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('master_customers')->onDelete('cascade');;
        });
        
        Schema::create('master_customer_main_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_main_id');
            $table->enum('contact_type', ['yes', 'no'])->nullable();
            $table->string('surname')->nullable();
            $table->string('gname')->nullable();
            $table->string('title')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('fax_1')->nullable();
            $table->string('fax_2')->nullable();
            $table->string('job_title')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();

            $table->foreign('customer_main_id')->references('id')->on('master_customer_mains')->onDelete('cascade');;
        });
        
        Schema::create('master_customer_basics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->integer('gender')->nullable();
            $table->enum('marital_status', ['yes', 'no'])->nullable();
            $table->string('insurance_no')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->date('dob')->nullable();
            $table->string('security_id')->nullable();
            $table->string('website')->nullable();
            $table->string('nickname')->nullable();
            $table->string('ic_no_1')->nullable();
            $table->string('ic_no_1_country')->nullable();
            $table->string('ic_no_2')->nullable();
            $table->string('ic_no_2_country')->nullable();
            $table->string('nationality_1')->nullable();
            $table->string('nationality_2')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('master_customers')->onDelete('cascade');;

        });
        
        Schema::create('master_customer_generals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->string('exit_permit_no')->nullable();
            $table->date('exit_permit_exp_date')->nullable();
            $table->string('seat_pref')->nullable();
            $table->string('seat_pref_remark')->nullable();
            $table->string('meal')->nullable();
            $table->string('meal_remark')->nullable();
            $table->string('other_pref')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('master_customers')->onDelete('cascade');;
        });
        
        Schema::create('master_customer_general_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('master_customer_general_id');
            $table->string('passport_no')->nullable();
            $table->string('issue_country')->nullable();
            $table->string('nationality')->nullable();
            $table->string('type')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('entry_country')->nullable();
            $table->string('passenger_name')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
            
            $table->foreign('master_customer_general_id')->references('id')->on('master_customer_generals')->onDelete('cascade');;
        });
        
        Schema::create('master_customer_discount_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->string('product_code')->nullable();
            $table->float('discount_percentage')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('master_customers')->onDelete('cascade');;
        });
        
        Schema::create('master_customer_credit_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->string('card_type')->nullable();
            $table->string('merchant_no')->nullable();
            $table->string('merchant_no_int')->nullable();
            $table->string('credit_card_no')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('cardholder_name')->nullable();
            $table->string('bill_type')->nullable();
            $table->boolean('preferred_card')->nullable();
            $table->string('sof')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('master_customers')->onDelete('cascade');;
        });
        
        Schema::create('master_customer_termfees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->float('credit_limit')->nullable();
            $table->string('share_credit_code')->nullable();
            $table->float('addon_credit_limit')->nullable();
            $table->date('addon_from_date')->nullable();
            $table->date('addon_to_date')->nullable();
            $table->string('credit_term_type')->nullable();
            $table->enum('invoce_delivery_method', ['yes', 'no'])->nullable();
            $table->enum('recall_commission_method', ['yes', 'no'])->nullable();
            $table->enum('rebate_method', ['yes', 'no'])->nullable();
            $table->integer('rebate_amount_type_id')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('master_customers')->onDelete('cascade');;
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

        Schema::dropIfExists('master_customer_main_contacts');
        Schema::dropIfExists('master_customer_mains');
        Schema::dropIfExists('master_customer_basics');
        Schema::dropIfExists('master_customer_general_docs');
        Schema::dropIfExists('master_customer_generals');
        Schema::dropIfExists('master_customer_discount_rates');
        Schema::dropIfExists('master_customer_credit_cards');
        Schema::dropIfExists('master_customer_termfees');
        Schema::dropIfExists('master_customers');

        Schema::enableForeignKeyConstraints();
    }
}
