<?php

use Illuminate\Database\Seeder;
use App\OfferOfConvocatory;

class OfferOfConvocatorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('OfferOfConvocatory')->delete();
        
        $offerOfConvocatory = new OfferOfConvocatory();
        $offerOfConvocatory->id = 3;
	$offerOfConvocatory->convocatory_id = 1;
        $offerOfConvocatory->costs = 'El coste medio de vida en la zona es de 400€, y el viaje de ida y vuelta 1000€';
        $offerOfConvocatory->housing = 'Te podrás alojar en una habitación de la propia ONG de forma gratuita';
        $offerOfConvocatory->save();
    }
}
