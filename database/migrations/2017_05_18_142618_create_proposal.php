<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Proposal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('offer_id')->unsigned();
            
            $table->string('description', config('forms.proposal_description'));
            $table->tinyInteger('type');
            //Schedule available weekly, in total hours or in weekly schedule
            $table->string('scheduleAvailable', config('forms.scheduleAvailable'));
            $table->string('totalHours', config('forms.proposal_totalHours'));
            $table->string('earliestStartDate', config('forms.earliestStartDate'));
            $table->string('latestEndDate', config('forms.latestEndDate'));
            $table->tinyInteger('state');
            $table->date('creationDate');
            
            $table->foreign('student_id')->references('id')->on('Student')
                    ->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('Offer')
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
        Schema::dropIfExists('Proposal');
    }
}
