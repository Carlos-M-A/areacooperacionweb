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
            $table->boolean('isOfferOfConvocatory');
            $table->boolean('open');
            $table->string('title', config('forms.offer_title'));
            $table->string('scope', config('forms.scope'));
            $table->text('description');
            $table->text('requeriments')->nullable();
            $table->text('workplan')->nullable();
            $table->string('workplace', config('forms.workplace'));
            $table->string('schedule', config('forms.schedule'));
            $table->string('totalHours', config('forms.offer_totalHours'));
            $table->string('possibleStartDates', config('forms.possibleStartDates'));
            $table->string('possibleEndDates', config('forms.possibleEndDates'));
            $table->integer('places')->unsigned();
            $table->string('monetaryHelp', config('forms.monetaryHelp'));
            $table->string('personInCharge', config('forms.personInCharge'));
            $table->date('createdDate');
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
