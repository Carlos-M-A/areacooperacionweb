<?php

use Illuminate\Database\Seeder;
use App\ObservatoryRequest;

class ObservatoryRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ObservatoryRequest')->delete();
        
        $request = new ObservatoryRequest();
        $request->id = 4;
        $request->save();
    }
}
