<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Organization', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->text('description');
            $table->string('headquartersLocation', config('forms.headquartersLocation'));
            $table->string('web', config('forms.url'));
            //If the organization is placed so far, as other country
            $table->string('linksWithNearbyEntities', config('forms.linksWithNearbyEntities'))->nullable();
            
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
        Schema::dropIfExists('Organization');
    }
}
