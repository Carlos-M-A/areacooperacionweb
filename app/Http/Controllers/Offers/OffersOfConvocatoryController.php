<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\OfferOfConvocatory;

class OffersOfConvocatoryController extends Controller
{
    public function createOfferOfConvocatory(Request $request, Offer $offer) {
        $offerOfConvocatory = new OfferOfConvocatory();
        $offerOfConvocatory->id = $offer->id;
        $offerOfConvocatory->convocatory_id = $request->convocatoryId;
        $offerOfConvocatory->housing = $request->housing;
        $offerOfConvocatory->costs = $request->costs;
        $offerOfConvocatory->save();
        return;
    }
}
