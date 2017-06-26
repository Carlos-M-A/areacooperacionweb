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
            $table->integer('study_id')->unsigned();
            $table->integer('teacher_id')->unsigned()->nullable();
            
            $table->string('title', config('forms.project_title'));
            $table->string('scope', config('forms.scope'));
            $table->string('description', config('forms.project_description'));
            $table->string('tutor', config('forms.tutor'));
            $table->string('author', config('forms.author'))->nullable();
            $table->string('urlDocumentation', config('forms.url'))->nullable();
            $table->tinyInteger('state');
            $table->date('finishedDate')->nullable();
            $table->date('createdDate');
            $table->boolean('createdByAdmin');
            
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
