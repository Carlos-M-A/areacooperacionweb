<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(CampusSeeder::class);
        $this->call(StudySeeder::class);
        
        /*
        $this->call(StudentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(OtherSeeder::class);
        $this->call(ObservatoryRequestSeeder::class);
        $this->call(RoleChangeRequestSeeder::class);
        $this->call(ConvocatorySeeder::class);
        $this->call(OfferSeeder::class);
        $this->call(OfferOfConvocatorySeeder::class);
        $this->call(ProjectSeeder::class);
	$this->call(InscriptionSeeder::class);
	$this->call(InscriptionInProjectSeeder::class);
	$this->call(ProposalSeeder::class);
         */
    }
}
