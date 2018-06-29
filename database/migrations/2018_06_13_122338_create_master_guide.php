<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterGuide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('tour_guide_visas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country')->nullable();
            $table->string('purpose')->nullable();
            $table->string('entries_no')->nullable();
            $table->string('visa_no')->nullable();
            $table->string('visa_date')->nullable();
            $table->date('visa_expiry')->nullable();
            $table->text('visa_remark')->nullable();
            $table->string('issue_country')->nullable();
            $table->timestamps();
        });

        Schema::create('master_tour_guides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guide_code')->nullable();
            $table->string('guide_status')->nullable();
            $table->string('supplier_no')->nullable();
            $table->string('guide_name_first')->nullable();
            $table->string('guide_name_last')->nullable();
            $table->integer('tour_guide_visa_id');
            $table->boolean('is_draft')->nullable()->default(true);
            $table->integer('company_id')->nullable();
            $table->integer('branch_id')->nullable();

            $table->timestamps();

            $table->foreign('tour_guide_visa_id')->references('id')->on('tour_guide_visas')->onDelete('cascade');
        });

        Schema::create('master_tour_guide_basics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_tour_guide_id');
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->string('id_no')->nullable();
            $table->string('nationality_1')->nullable();
            $table->string('nationality_2')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('license_no')->nullable();
            $table->date('license_expiry_date')->nullable();
            $table->string('exit_permit_no')->nullable();
            $table->string('passport1')->nullable();
            $table->date('passport1_issue_date')->nullable();
            $table->string('passport1_isseu_place')->nullable();
            $table->date('passport1_expiry_date')->nullable();
            $table->string('passport2')->nullable();
            $table->date('passport2_issue_date')->nullable();
            $table->string('passport2_isseu_place')->nullable();
            $table->date('passport2_expiry_date')->nullable();
            $table->timestamps();

            $table->foreign('master_tour_guide_id')->references('id')->on('master_tour_guides')->onDelete('cascade');
        });

        Schema::create('master_tour_guide_mains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_tour_guide_id');
            $table->string('job_title')->nullable();
            $table->string('home_tel')->nullable();
            $table->string('mobile')->nullable();
            $table->string('office_tel')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('email')->nullable();
            $table->text('office_addr')->nullable();
            $table->text('home_addr')->nullable();
            $table->text('remark')->nullable();
            $table->date('start_date')->nullable();
            $table->string('expertise')->nullable();
            $table->string('religion')->nullable();
            $table->text('language')->nullable();
            $table->timestamps();

            $table->foreign('master_tour_guide_id')->references('id')->on('master_tour_guides')->onDelete('cascade');
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

        Schema::dropIfExists('master_tour_guide_basics');
        Schema::dropIfExists('master_tour_guide_mains');
        Schema::dropIfExists('master_tour_guides');
        Schema::dropIfExists('tour_guide_visas');

        Schema::enableForeignKeyConstraints();
    }
}
