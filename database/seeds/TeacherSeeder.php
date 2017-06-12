<?php

use Illuminate\Database\Seeder;
use App\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Teacher')->delete();
        
        $teacher = new Teacher();
        $teacher->id = 5;
        $teacher->areasOfInterest = 'areas interes teacher';
        $teacher->departments = 'departamentos teacher';
        $teacher->save();
        
        DB::table('Study_Teacher')->insert([
            'teacher_id' => 5,
            'study_id' => 1,
        ]);
        DB::table('Study_Teacher')->insert([
            'teacher_id' => 5,
            'study_id' => 2,
        ]);
        DB::table('Study_Teacher')->insert([
            'teacher_id' => 5,
            'study_id' => 3,
        ]);
        
    }
}
