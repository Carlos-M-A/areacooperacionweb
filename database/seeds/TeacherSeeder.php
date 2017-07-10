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
        $teacher->areasOfInterest = 'Estoy muy interesada en todos los proyectos de cooperación al desarrollo en los que podamos ayudar desde el conocimiento en la informática. Aunque de forma especial, me interesan el comercio justo y el ecologismo.';
        $teacher->departments = 'Podeis encontrarme en el departamento de informática en la Escuela de Ingeniería Informática. Despacho 1D3234';
        $teacher->save();
        
        DB::table('Study_Teacher')->insert([
            'teacher_id' => 5,
            'study_id' => 1,
        ]);
        DB::table('Study_Teacher')->insert([
            'teacher_id' => 5,
            'study_id' => 2,
        ]);
        
    }
}
