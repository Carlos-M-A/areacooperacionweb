<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Support\Facades\Auth;

class ProposalsController extends Controller {

    /**
     * Return the offers in that exists a proposal has been made
     *  by the student who calls this function
     */
    public function offersWithProposal() {
        $offers = Offer::whereHas('proposals', function ($query) {
                    $user = Auth::user();
                    $query->where('student_id', $user->id);
                });

        return view('offers/offers')->with('offers', $offers->paginate(config('constants.pagination')))->with('ask', 2);
    }

    /**
     * Return the offers in that exists a acepted proposal has been made
     *  by the student who calls this function
     */
    public function approvedProposals() {
        $offers = Offer::whereHas('proposals', function ($query) {
                    $user = Auth::user();
                    $query->where('student_id', $user->id)->where('state', 2);
                });

        return view('offers/offers')->with('offers', $offers->paginate(config('constants.pagination')))->with('ask', 3);
    }

    /**
     * Return the offers in that exists a acepted proposal has been made
     *  by the student who calls this function
     */
    public function acceptedProposals() {
        $offers = Offer::whereHas('proposals', function ($query) {
                    $user = Auth::user();
                    $query->where('student_id', $user->id)->where('state', 4);
                });

        return view('offers/offers')->with('offers', $offers->paginate(config('constants.pagination')))->with('ask', 4);
    }
    
}
