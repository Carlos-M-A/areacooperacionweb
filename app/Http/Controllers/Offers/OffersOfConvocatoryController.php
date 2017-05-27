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
    
    public function editOfferOfConvocatory(Request $request, Offer $offer) {
        $offerOfConvocatory = OfferOfConvocatory::find($offer->id);
        if(is_null($offerOfConvocatory)){
            if($offer->isOfferOfConvocatory){
                $offerOfConvocatoryNew = new OfferOfConvocatory();
                $offerOfConvocatoryNew->id = $offer->id;
                $offerOfConvocatoryNew->convocatory_id = $request->convocatoryId;
                $offerOfConvocatoryNew->housing = $request->housing;
                $offerOfConvocatoryNew->costs = $request->costs;
                $offerOfConvocatoryNew->save();
                return;
            } else {
                return;
            }
        } else {
            if($offer->isOfferOfConvocatory){
                $offerOfConvocatory->convocatory_id = $request->convocatoryId;
                $offerOfConvocatory->housing = $request->housing;
                $offerOfConvocatory->costs = $request->costs;
                $offerOfConvocatory->save();
            } else {
                $offerOfConvocatory->delete();
            }
        }
    }
}
