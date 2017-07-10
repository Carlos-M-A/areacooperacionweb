<?php

use Illuminate\Database\Seeder;
use App\Convocatory;

class ConvocatorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Convocatory')->delete();
        
        $convocatory = new Convocatory();
        $convocatory->title = 'Prácticas PACID 2017';
        $convocatory->information = 'La Universidad de Valladolid cuenta con un programa propio de prácticas en proyectos de cooperación al desarrollo. Este programa, denominado PACID, Prácticas Académicas en el ámbito de la Cooperación Internacional para el Desarrollo, se inició en el año 2008 con la cofinanciación de la Junta de Castilla y León. Desde entonces, en sus cinco ediciones, ha posibilitado la realización de estancias de entre dos y tres meses a 93 estudiantes de la UVa, en diferentes entidades sociales de países empobrecidos.

El objetivo del programa ha sido, desde sus inicios, facilitar un conocimiento práctico y directo de algunas realidades del sur, sus logros, dificultades y anhelos para construir modelos y espacios de desarrollo endógeno y sostenible. A raíz de estas experiencias, la pretensión es que las personas  implicadas, a su regreso, se comprometan de diversas maneras con iniciativas y procesos de transformación social en su entorno más cercano.

 El programa, se desarrolla en tres fases:

    Formación específica sobre Desarrollo y Participación.
    Estancias PACID.
    El regreso: la devolución de la experiencia';
        $convocatory->estimatedPeriod = 'Entre julio y octubre de 2017';
        $convocatory->urlDocumentation = 'https://sede.uva.es/opencms/opencms/es/Tablones/Tablon_de_Anuncios/RELACIONES_INTERNACIONALES/tablon_0342.html';
        $convocatory->state = 2;
        $convocatory->deadline = '2017-3-3';
        $convocatory->createdDate = '2017-2-2';
        $convocatory->save();

        $convocatory = new Convocatory();
        $convocatory->title = 'Prácticas PACID 2016';
        $convocatory->information = 'La Universidad de Valladolid cuenta con un programa propio de prácticas en proyectos de cooperación al desarrollo. Este programa, denominado PACID, Prácticas Académicas en el ámbito de la Cooperación Internacional para el Desarrollo, se inició en el año 2008 con la cofinanciación de la Junta de Castilla y León. Desde entonces, en sus cinco ediciones, ha posibilitado la realización de estancias de entre dos y tres meses a 93 estudiantes de la UVa, en diferentes entidades sociales de países empobrecidos.';
        $convocatory->estimatedPeriod = 'Entre julio y octubre de 2016';
        $convocatory->urlDocumentation = 'https://sede.uva.es/opencms/opencms/es/Tablones/Tablon_de_Anuncios/RELACIONES_INTERNACIONALES/tablon_0342.html';
        $convocatory->state = 3;
        $convocatory->deadline = '2016-3-3';
        $convocatory->createdDate = '2016-2-3';
        $convocatory->save();
    }
}
