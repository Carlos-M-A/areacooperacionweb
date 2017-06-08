<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\OfferOfConvocatory;

class OfferOfConvocatoryController extends Controller {

    public function createOfferOfConvocatory(Request $request, Offer $offer) {
        $this->_newOfferOfConvocatory($request, $offer);
        return;
    }

    public function editOfferOfConvocatory(Request $request, Offer $offer) {
        $offerOfConvocatory = OfferOfConvocatory::find($offer->id);
        if (is_null($offerOfConvocatory)) {
            if ($offer->isOfferOfConvocatory) {
                $this->_newOfferOfConvocatory($request, $offer);
                return;
            } else {
                return;
            }
        } else {
            if ($offer->isOfferOfConvocatory) {
                $offerOfConvocatory->convocatory_id = $request->convocatoryId;
                $offerOfConvocatory->housing = $request->housing;
                $offerOfConvocatory->costs = $request->costs;
                $offerOfConvocatory->save();
            } else {
                $offerOfConvocatory->delete();
            }
        }
    }
    
    private function _newOfferOfConvocatory(Request $request, Offer $offer){
        $offerOfConvocatory = new OfferOfConvocatory();
        $offerOfConvocatory->id = $offer->id;
        $offerOfConvocatory->convocatory_id = $request->convocatoryId;
        $offerOfConvocatory->housing = $request->housing;
        $offerOfConvocatory->costs = $request->costs;
        $offerOfConvocatory->save();
    }

}
