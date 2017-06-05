<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Student')->delete();
        
        $student = new Student();
        $student->id = 6;
        $student->surnames = 'Apellidos estu';
        $student->areasOfInterest = 'Area interes estu';
        $student->skills = 'Competencias estu';
        $student->study_id = 1;
        $student->save();
        
       
    }
}
