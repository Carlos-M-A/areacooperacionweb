    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionInProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InscriptionInProject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('project_id')->unsigned();
            
            $table->tinyInteger('state');
            $table->string('comment', config('forms.comment'))->nullable();
            $table->dateTime('createdDate');
            
            $table->foreign('student_id')->references('id')->on('Student')
                    ->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('Project')
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
        Schema::dropIfExists('InscriptionInProject');
    }
}
