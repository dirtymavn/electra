<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_type');
            $table->string('document_uri');
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->boolean('is_draft')->nullable()->default(true);

            $table->timestamps();
        });

        Schema::create('master_queue_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attached_document')->unsigned()->nullable();
            $table->text('queue_message')->nullable();
            $table->date('due_date')->nullable();
            $table->string('subject')->nullable();
            $table->string('target_role')->nullable();
            $table->integer('spesific_role')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('master_queue_messages');
        Schema::dropIfExists('master_documents');
    }
}
