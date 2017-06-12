<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Study', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', config('forms.study_name'));
            $table->tinyInteger('branch');
            $table->boolean('inactive');
            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')->references('id')->on('Campus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Study');
    }
}
