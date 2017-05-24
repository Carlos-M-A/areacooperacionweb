<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Project', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proposal_id')->unsigned()->nullable();
            $table->integer('offer_id')->unsigned()->nullable();
            $table->integer('study_id')->unsigned()->nullable();
            
            $table->string('title', 200);
            $table->string('scope', 200);
            $table->tinyInteger('type');
            $table->string('description', 500);
            $table->string('author', 200);
            $table->string('tutor', 200)->nullable();
            $table->string('organization', 100);
            $table->string('urlDocumentation', 200)->nullable();
            $table->smallInteger('year');
            $table->tinyInteger('state');
            
            $table->foreign('proposal_id')->references('id')->on('Proposal');
            $table->foreign('offer_id')->references('id')->on('Offer');
            $table->foreign('study_id')->references('id')->on('Study');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Project');
    }
}
