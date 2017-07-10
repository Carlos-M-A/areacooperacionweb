<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Student', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->text('areasOfInterest');
            $table->text('skills');
            $table->string('urlCurriculum', config('forms.url'))->nullable();
            $table->integer('study_id')->unsigned();
            
            $table->primary('id');
            $table->foreign('id')->references('id')->on('User')
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
        Schema::dropIfExists('Student');
    }
}
