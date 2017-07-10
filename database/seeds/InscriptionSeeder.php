<?php

use Illuminate\Database\Seeder;
use App\Inscription;

class InscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Inscription')->delete();

	$inscription = new Inscription();
	$inscription->student_id = 6;
	$inscription->convocatory_id = 1;
	$inscription->state = 1;
	$inscription->score = 0.0;
	$inscription->observations = '';
	$inscription->save();

	$inscription = new Inscription();
	$inscription->student_id = 9;
	$inscription->convocatory_id = 1;
	$inscription->state = 1;
	$inscription->score = 0.0;
	$inscription->observations = '';
	$inscription->save();
    }
}
