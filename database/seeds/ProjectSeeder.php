<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Project')->delete();

        $project = new Project();
        $project->title = 'Desarrollo aplicación web para gestionar proyectos de economia colaborativa';
	$project->scope = 'Economia social';
        $project->description = 'Desarrollo de una aplicación web, en PHP y con un Framework de uso común, que ayude a gestionar los distintos aspectos administrativos de un proyecto de economia colaborativa';
        $project->tutor = 'Laura Pascual Hernandez';
        $project->author = '';
	$project->urlDocumentation = '';
        $project->state = 1;
        $project->finishedDate = null;
        $project->createdDate = '2017-2-3';
	$project->createdByAdmin = false;
	$project->study_id = 1;
	$project->teacher_id = 5;
        $project->save();

        $project = new Project();
        $project->title = 'Aplicación movil para el autocontrol del consumo';
	$project->scope = 'Consumo responsable';
        $project->description = 'Aplicación movil desarrollada en Android que ayuda a tener un control del propio consumo, permitiendo ver en que empresas o entidades se ha gastado mayor cantidad de dinero, ayudando a concienciar sobre nuestra forma de consumir';
        $project->tutor = 'Laura Pascual Hernandez';
        $project->author = '';
	$project->urlDocumentation = '';
        $project->state = 1;
        $project->finishedDate = null;
        $project->createdDate = '2017-2-1';
	$project->createdByAdmin = false;
	$project->study_id = 1;
	$project->teacher_id = 5;
        $project->save();

        $project = new Project();
        $project->title = 'Diseño, desarrollo y evaluación de una propuesta de educación para el desarrollo en un aula de Educación Primaria';
	$project->scope = 'Educación para el desarrollo';
        $project->description = 'Aula educación';
        $project->tutor = 'Josega Alsua';
        $project->author = 'ALsa Cousa';
	$project->urlDocumentation = 'http://laravel.com';
        $project->state = 3;
        $project->finishedDate = '2016-4-5';
        $project->createdDate = '2016-2-3';
	$project->createdByAdmin = true;
	$project->study_id = 1;
	$project->teacher_id = null;
        $project->save();

        $project = new Project();
        $project->title = 'La Educación Primaria en África: experiencia en Ghana';
	$project->scope = 'Africa';
        $project->description = 'Investigación educación africa';
        $project->tutor = 'Gonzalo Fonseca Raul';
        $project->author = 'Maria Siguienza lopez';
	$project->urlDocumentation = 'http://laravel.com';
        $project->state = 3;
        $project->finishedDate = '2017-4-4';
        $project->createdDate = '2017-2-3';
	$project->createdByAdmin = true;
	$project->study_id = 1;
	$project->teacher_id = null;
        $project->save();

    }
}
