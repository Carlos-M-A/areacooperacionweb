<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Offer;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller {

    public function myOffers() {
        $user = Auth::user();
        
        if ($user->role == 4) {
            $offers = Offer::where('organization_id', $user->id)->where('managedByArea', 0);
        }
        if ($user->role == 5) {
            $offers = Offer::where('managedByArea', 1);
        }
        return view('offers/offers')->with('offers', $offers->paginate(config('constants.pagination')));
    }
    public function myOpenOffers() {
        $offers = Offer::where('open', 1);
        $user = Auth::user();

        if ($user->role == 4) {
            $offers->where('organization_id', $user->id)->where('managedByArea', 0);
        }
        if ($user->role == 5) {
            $offers->where('managedByArea', 1);
        }

        return view('offers/offers')->with('offers', $offers->paginate(config('constants.pagination')));
    }

    public function myClosedOffers() {
        $offers = Offer::where('open', 0);
        $user = Auth::user();

        if ($user->role == 4) {
            $offers->where('organization_id', $user->id)->where('managedByArea', 0);
        }
        if ($user->role == 5) {
            $offers->where('managedByArea', 1);
        }

        return view('offers/offers')->with('offers', $offers->paginate(config('constants.pagination')));
    }
    
    /**
     * Return the offers in that no proposal has been made by the student who
     * call this function
     */
    public function newOffers() {
        $offers = Offer::whereDoesntHave('proposals', function ($query) {
                    $user = Auth::user();
                    $query->where('student_id', $user->id);
                })->where('open', true);

        return view('offers/offers')->with('offers', $offers->paginate(config('constants.pagination')));
    }
}
