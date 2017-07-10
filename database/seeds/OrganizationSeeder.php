<?php

use Illuminate\Database\Seeder;
use App\Organization;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Organization')->delete();
        
        
        $organization = new Organization();
        $organization->id = 2;
        $organization->description = 'Órgano de la UVa encargado de gestionar todo las actividadesddy recursos de la universidad dedicados a cooperación al desarrollo y la ayuda humanitaria.';
        $organization->headquartersLocation = 'Edificio Tejerina, Plaza Santa Cruz. 5º planta';
        $organization->web = 'http://www.eii.uva.es/webcooperacion/';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
        
        /*
        $organization = new Organization();
        $organization->id = 3;
        $organization->description = 'Somos una ONG y nuestra librería nos sirve para financiar la creación de bibliotecas en Países del Sur. Todos los libros nos los han dado en donación, por eso nuestros fondos son tan variados. Tenemos también la librería física en la Calle Carmelo nº3 de Valladolid. Es un espacio en el que aunamos tienda de comercio justo y ecológica, espacio de cafetería degustación (eco y de comercio justo) y los libros.';
        $organization->headquartersLocation = 'C/Carmelo nº3, 47013-Valladolid, España';
        $organization->web = 'https://es-es.facebook.com/ONGazacan/';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
        
        $organization = new Organization();
        $organization->id = 7;
        $organization->description = 'Asamblea de Cooperación Por la Paz (ACPP) es un instrumento, un punto de encuentro de personas que aspiran a vivir en un mundo que cimente sus pilares en la dignidad, la justicia y la igualdad y se ponen a ello para aportar colectivamente su granito de arena. Las reglas del juego no son neutras y el trabajo de ACPP se enmarca en el deseo de cambiarlas desde la práctica cotidiana. ACPP tampoco es neutra, su labor se encamina a lograr una sociedad más igualitaria en la que todas las personas tengan la posibilidad de vivir una vida digna. La cooperación internacional, la acción en las escuelas, la intervención social en nuestros barrios y ciudades y la sensibilización ciudadana son puntos de apoyo fundamentales en esta labor de incidencia política. ACPP se define como una organización independiente, progresista y laica. ';
        $organization->headquartersLocation = 'Fuente El Sol, 1, 3º B, 47009, Valladolid';
        $organization->web = 'http://www.acpp.com/';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
        
        $organization = new Organization();
        $organization->id = 8;
        $organization->description = '

CAMBIAMOS VIDAS QUE CAMBIAN VIDAS

1 de cada 3 personas en el mundo vive en la pobreza. En Oxfam Intermón estamos decididos a cambiar esta situación, movilizando el poder de las personas contra la pobreza.

Trabajamos en todo el mundo con herramientas innovadoras y eficaces, para lograr que las personas puedan salir de la pobreza por sí mismas y prosperar. Salvamos vidas en situaciones de emergencia y ayudamos a recuperar medios de vida. Impulsamos campañas para que las voces de las personas en situación de pobreza puedan influir en las decisiones que les afectan en el ámbito local y global.';
        $organization->headquartersLocation = 'Calle Embajadores, 3, 3ºD, Valladolid';
        $organization->web = 'http://www.oxfamintermon.org/es';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
         */
    }
}
