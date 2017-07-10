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
        $student->areasOfInterest = 'Todo lo que sea ayudar!! Especialmente Comercio justo y Ecología';
        $student->skills = 'Todo lo aprendido en mis 4 años en el grado de informática.
Tengo mucha experiencia con niños. He trabajado en verano en escuelas infantiles y desde hace 3 años soy Scout. Además, tengo el grado de FP de mecánica y carroceria';
        $student->study_id = 1;
        $student->save();
        
       
        $student = new Student();
        $student->id = 9;
        $student->areasOfInterest = 'Todo lo que tenga que ver con las problemáticas de género y LGTBI';
        $student->skills = 'Todo lo aprendido en mis 4 años en el grado de informática.
Tengo mucha experiencia con niños. He trabajado en verano en escuelas infantiles y desde hace 3 años soy Scout. Además, tengo el grado de FP de mecánica y carroceria';
        $student->study_id = 1;
        $student->save();
    }
}
