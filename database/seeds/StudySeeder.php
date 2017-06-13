<?php

use Illuminate\Database\Seeder;
use App\Study;

class StudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Study')->delete();

        $study = new Study();
        $study->name = 'Grado en Enfermería 1';
        $study->branch = 3;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Enfermería2';
        $study->branch = 3;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Enfermería3';
        $study->branch = 3;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Enfermería4';
        $study->branch = 3;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Enfermería5';
        $study->branch = 3;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Enfermería6';
        $study->branch = 3;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Enología';
        $study->branch = 5;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Ingeniería Agrícola y del Medio Rural';
        $study->branch = 5;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Ingeniería Forestal y del Medio Natural';
        $study->branch = 5;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Ingeniería de las Industrias Agrarias y Alimentarias';
        $study->branch = 5;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Relaciones Laborales y Recursos Humanos';
        $study->branch = 4;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Educación Infantil';
        $study->branch = 4;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Educación Primaria';
        $study->branch = 4;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Grado en Educación Social';
        $study->branch = 4;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        $study = new Study();
        $study->name = 'Programa de estudios conjunto de Grado en Educación Infantil y Grado en Educación Primaria';
        $study->branch = 4;
        $study->inactive = false;
        $study->campus_id = 2;
        $study->save();
        
        
    }
}
