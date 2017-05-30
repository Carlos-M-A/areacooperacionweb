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
            $table->integer('study_id')->unsigned()->nullable();
            $table->integer('teacher_id')->unsigned()->nullable();
            
            $table->string('title', 200);
            $table->string('scope', 200);
            $table->text('description');
            $table->string('tutor', 200)->nullable();
            $table->string('urlDocumentation', 200)->nullable();
            $table->tinyInteger('state');
            $table->dateTime('createdDate');
            
            $table->foreign('study_id')->references('id')->on('Study');
            $table->foreign('teacher_id')->references('id')->on('Teacher');
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
