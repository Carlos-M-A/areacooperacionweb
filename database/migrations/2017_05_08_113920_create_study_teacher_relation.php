<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyTeacherRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Study_Teacher', function (Blueprint $table) {
            $table->integer('teacher_id')->unsigned();
            $table->integer('study_id')->unsigned();
            $table->primary(['teacher_id', 'study_id']);
            $table->foreign('teacher_id')->references('id')->on('Teacher')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('Study_Teacher');
    }
}
