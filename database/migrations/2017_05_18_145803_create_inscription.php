<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Inscription', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('convocatory_id')->unsigned();
            $table->tinyInteger('state');
            $table->float('score', 5, 3);
            $table->string('observations', config('forms.observations'));
            
            $table->foreign('student_id')->references('id')->on('Student')
                    ->onDelete('cascade');
            $table->foreign('convocatory_id')->references('id')->on('Convocatory')
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
        Schema::dropIfExists('Inscription');
    }
}
