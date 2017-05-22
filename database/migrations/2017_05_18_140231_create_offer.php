<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Offer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->boolean('managedByArea');
            $table->boolean('open');
            $table->string('title', 100);
            $table->string('scope', 100);
            $table->text('description');
            $table->string('requeriments', 500)->nullable();
            $table->text('workplan')->nullable();
            $table->string('schedule', 200);
            $table->string('totalHours', 200);
            $table->string('possibleStartDates', 200);
            $table->string('possibleEndDates', 200);
            $table->integer('places')->unsigned();
            $table->integer('placesOccupied')->unsigned();
            $table->string('monetaryHelp', 200);
            $table->string('personInCharge', 100);
            $table->dateTime('createdDate');
            $table->date('deadline');
            
            $table->foreign('organization_id')->references('id')->on('Organization')
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
        Schema::dropIfExists('Offer');
    }
}
