
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
            $table->string('title', 200);
            $table->string('information', 500);
            $table->string('estimatedPeriod', 200);
            $table->string('urlDocumentation', 200);
            $table->tinyInteger('state');
            $table->date('deadline');
            $table->dateTime('createdDate');
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
