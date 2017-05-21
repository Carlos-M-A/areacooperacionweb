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
            
            $table->string('description', 500);
            $table->tinyInteger('type');
            //Schedule available weekly, in total hours or in weekly schedule
            $table->string('scheduleAvailable', 200);
            $table->string('totalHours', 200);
            $table->string('earliestStartDate', 200);
            $table->string('latestEndDate', 200);
            $table->string('motivation', 200)->nullable();
            $table->tinyInteger('state');
            $table->dateTime('creationDate');
            
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
