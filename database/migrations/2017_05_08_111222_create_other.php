<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOther extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Other', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->text('areasOfInterest');
            $table->text('description');
            
            $table->primary('id');
            $table->foreign('id')->references('id')->on('User')
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
        Schema::dropIfExists('Other');
    }
}
