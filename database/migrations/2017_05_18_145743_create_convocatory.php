
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvocatory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Convocatory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', config('forms.convocatory_title'));
            $table->string('information', config('forms.information'));
            $table->string('estimatedPeriod', config('forms.estimatedPeriod'));
            $table->string('urlDocumentation', config('forms.url'));
            $table->tinyInteger('state');
            $table->date('deadline');
            $table->date('createdDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Convocatory');
    }
}
