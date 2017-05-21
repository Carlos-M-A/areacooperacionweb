<?php

use Illuminate\Database\Seeder;
use App\Faculty;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Faculty')->delete();
        
        $faculty = new Faculty();
        $faculty->name = 'Escuela de Enfermería (Adscrito)';
        $faculty->city = 'Palencia';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Escuela Técnica Superior de Ingenierías Agrarias';
        $faculty->city = 'Palencia';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Ciencias del Trabajo';
        $faculty->city = 'Palencia';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Educación';
        $faculty->city = 'Palencia';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Escuela de Ingeniería Informática';
        $faculty->city = 'Segovia';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Ciencias Sociales, Jurídicas y de la Comunicación';
        $faculty->city = 'Segovia';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Educación';
        $faculty->city = 'Segovia';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Educación';
        $faculty->city = 'Soria';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Escuela Universitaria de Ingenierías Agrarias';
        $faculty->city = 'Soria';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Fisioterapia';
        $faculty->city = 'Soria';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Traducción e Interpretación';
        $faculty->city = 'Soria';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Ciencias Empresariales y del Trabajo';
        $faculty->city = 'Soria';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Enfermería';
        $faculty->city = 'Soria';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Ciencias';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Ciencias Económicas y Empresariales';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Comercio';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Derecho';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Educación y Trabajo Social';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Enfermería';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Filosofía y Letras';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Facultad de Medicina';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'ETS de Arquitectura';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Escuela de Ingenierías Industriales';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Escuela de Ingeniería Informática';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
        
        $faculty = new Faculty();
        $faculty->name = 'Escuela Técnica Superior de Ingenieros de Telecomunicación';
        $faculty->city = 'Valladolid';
        $faculty->inactive = false;
        $faculty->save();
    }
}
