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
        $other->areasOfInterest = 'Educación al desarrollo. Periodismo social';
        $other->description = 'Miembro honorifico del Observatorio. ';
        $other->save();
    }
}
