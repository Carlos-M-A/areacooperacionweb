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
        $convocatory->title = 'titulo convocatoria';
        $convocatory->information = 'info';
        $convocatory->estimatedPeriod = 'asdfad';
        $convocatory->urlDocumentation = 'adsfadf';
        $convocatory->year = 2016;
        $convocatory->state = 1;
        $convocatory->deadline = '2017-3-3';
        $convocatory->save();
    }
}
