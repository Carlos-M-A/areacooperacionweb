<?php

use Illuminate\Database\Seeder;
use App\InscriptionInProject;

class InscriptionInProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('InscriptionInProject')->delete();

	$inscription = new InscriptionInProject();
	$inscription->student_id = 9;
	$inscription->project_id = 1;
	$inscription->state = 1;
	$inscription->comment = 'Comentario';
	$inscription->createdDate = '2016-2-2';
	$inscription->save();
    }
}
