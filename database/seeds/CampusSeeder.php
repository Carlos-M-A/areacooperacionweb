<?php

use Illuminate\Database\Seeder;
use App\Campus;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Campus')->delete();
        
        $campus = new Campus();
        $campus->name = 'Campus de Valladolid';
        $campus->abbreviation = 'Valladolid';
        $campus->inactive = false;
        $campus->save();
        
        $campus = new Campus();
        $campus->name = 'Campus de Palencia';
        $campus->abbreviation = 'Palencia';
        $campus->inactive = false;
        $campus->save();
        
        $campus = new Campus();
        $campus->name = 'Campus de Segovia';
        $campus->abbreviation = 'Segovia';
        $campus->inactive = false;
        $campus->save();
        
        $campus = new Campus();
        $campus->name = 'Campus de Soria';
        $campus->abbreviation = 'Soria';
        $campus->inactive = false;
        $campus->save();
        
        
    }
}
