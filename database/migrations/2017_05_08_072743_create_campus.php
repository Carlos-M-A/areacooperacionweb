<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Campus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', config('forms.campus_name'));
            $table->string('abbreviation', config('forms.abbreviation'));
            $table->boolean('inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Campus');
    }
}
