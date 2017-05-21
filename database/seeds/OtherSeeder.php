<?php

use Illuminate\Database\Seeder;
use App\Other;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Other')->delete();
        
        $other = new Other();
        $other->id = 4;
        $other->surnames = 'apellidos other';
        $other->areasOfInterest = 'areas interes other';
        $other->description = 'descripción other';
        $other->save();
    }
}
