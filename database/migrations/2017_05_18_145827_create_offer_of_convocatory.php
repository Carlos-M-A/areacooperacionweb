<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferOfConvocatory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OfferOfConvocatory', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('convocatory_id')->unsigned();
            //Where the student will be housed
            $table->string('housing', config('forms.housing'));
            //Costs of the travel, housing, etc, at the place of destination
            $table->string('costs', config('forms.costs'));
            
            $table->primary('id');
            $table->foreign('id')->references('id')->on('Offer')
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
        Schema::dropIfExists('OfferOfConvocatory');
    }
}
