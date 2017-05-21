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
            //bussines name (On ONG is social name)
            $table->string('socialName', 200);
            $table->string('description', 500);
            $table->string('urlLogoImage', 200)->nullable();
            $table->string('headquartersLocation', 500);
            $table->string('web', 200);
            //If the organization is placed so far, as other country
            $table->string('linksWithNearbyEntities', 500)->nullable();
            
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
