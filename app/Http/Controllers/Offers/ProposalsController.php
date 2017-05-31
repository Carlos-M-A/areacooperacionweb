<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Proposal;
use App\Http\Controllers\Projects\ProjectsController;

use Illuminate\Support\Facades\Auth;

class ProposalsController extends Controller
{
    
    /**
     * Return the offers in that no proposal has been made by the student who
     * call this function
     */
    public function newOffers() {
        $offers = Offer::whereDoesntHave('proposals', function ($query) {
            $user = Auth::user();
            $query->where('student_id', $user->id);
        })->where('open', true);
        
        return view('offers/offers')->with('offers', $offers->get());
    }
    
    /**
     * Return the offers in that exists a proposal has been made
     *  by the student who calls this function
     */
    public function offersWithProposal() {
        $offers = Offer::whereHas('proposals', function ($query) {
            $user = Auth::user();
            $query->where('student_id', $user->id);
        });
        
        return view('offers/offers')->with('offers', $offers->get());
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
        
        return view('offers/offers')->with('offers', $offers->get());
    }
}
