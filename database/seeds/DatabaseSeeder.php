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
        $this->call(ObservatoryRequestSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(StudySeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(OtherSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(RoleChangeRequestSeeder::class);
        $this->call(ConvocatorySeeder::class);
    }
}
