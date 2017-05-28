<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutelageProposal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TutelageProposal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->integer('project_id')->unsigned();
            
            $table->tinyInteger('state');
            $table->string('comment', 500);
            //If the teacher wants to be contacted before being accepted
            $table->boolean('wantsToBeContacted');
            $table->dateTime('createdDate');
            
            $table->foreign('teacher_id')->references('id')->on('Teacher')
                    ->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('Project')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TutelageProposal');
    }
}
