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
        $organization->description = 'Órgano de la UVa encargado de gestionar todo las actividades y recursos de la universidad dedicados a cooperación al desarrollo y la ayuda humanitaria';
        $organization->headquartersLocation = 'Edificio Tejerina, Plaza Santa Cruz. 5º planta';
        $organization->web = 'http://www.eii.uva.es/webcooperacion/';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
        
        $organization = new Organization();
        $organization->id = 3;
        $organization->description = 'Organization no gestionada descripcion';
        $organization->headquartersLocation = 'ubucacion org no gestionada';
        $organization->web = 'nogestionada.com';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
        
        $organization = new Organization();
        $organization->id = 7;
        $organization->description = 'Organization gestionada 1';
        $organization->headquartersLocation = 'ubucacion org gestionada';
        $organization->web = 'gestionada.com';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
        
        $organization = new Organization();
        $organization->id = 8;
        $organization->description = 'Organization  gestionada 2';
        $organization->headquartersLocation = 'ubucacion org gestionada';
        $organization->web = 'gestionada.com';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
    }
}
