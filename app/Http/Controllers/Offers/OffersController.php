<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Proposal;
use App\OfferOfConvocatory;
    
class OffersController extends Controller
{
    
    public function openOffers() {
        $offers = Offer::where('open', 1);
        $user = Auth::user();
        
        if($user->role == 4){
            $offers->where('organization_id', $user->id)->where('managedByArea', 0);
        }
        if($user->role == 5){
            $offers->where('managedByArea', 1);
        }
        
        return view('offers/offers')->with('offers', $offers->get());
    }
    
    public function closedOffers() {
        $offers = Offer::where('open', 0);
        $user = Auth::user();
        
        if($user->role == 4){
            $offers->where('organization_id', $user->id)->where('managedByArea', 0);
        }
        if($user->role == 5){
            $offers->where('managedByArea', 1);
        }
        
        return view('offers/offers')->with('offers', $offers->get());
    }
    
}
