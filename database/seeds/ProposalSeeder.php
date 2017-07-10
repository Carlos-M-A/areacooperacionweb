<?php

use Illuminate\Database\Seeder;
use App\Proposal;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Proposal')->delete();

	$proposal = new Proposal();
	$proposal->offer_id = 1;
	$proposal->student_id = 9;
	$proposal->description = 'Estoy muy interesado';
	$proposal->type = 1;
	$proposal->scheduleAvailable = ' Solo las tardes';
	$proposal->totalHours = '400';
	$proposal->earliestStartDate = 'El 15 de febrero';
	$proposal->latestEndDate = 'El 5 de junio';
	$proposal->state = 1;
	$proposal->creationDate = '2017-6-1';
	$proposal->save();
    }
}
