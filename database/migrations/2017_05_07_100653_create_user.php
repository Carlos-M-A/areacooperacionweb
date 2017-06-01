<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', config('forms.user_name'));
            $table->string('email', config('forms.email'))->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('idCard', config('forms.idCard'))->unique();
            $table->string('phone', config('forms.phone'));
            $table->tinyInteger('role');
            $table->boolean('accepted');
            $table->boolean('isObservatoryMember');
            $table->boolean('isSubscriber');
            $table->boolean('notificationInfoConvocatories');
            $table->boolean('notificationInfoProjects');
            $table->dateTime('lastConnectionDate')->nullable();
            $table->dateTime('createdDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User');
    }
}
