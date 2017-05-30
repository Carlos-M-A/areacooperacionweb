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
    public function create($id, Request $request) {
        $offer = Offer::find($id);
        $user = Auth::user();
        
        $rules = [
            'type' => 'required|integer|max:6|min:1',
            'description' => 'required|string|max:100',
            'scheduleAvailable' => 'required|string|max:100',
            'totalHours' => 'required|string|max:100',
            'earliestStartDate' => 'required|string|max:100',
            'latestEndDate' => 'required|string|max:100',
        ];
        $this->validate($request, $rules);
        
        $proposal = new Proposal();
        $proposal->type = $request->type;
        $proposal->description = $request->description;
        $proposal->scheduleAvailable = $request->scheduleAvailable;
        $proposal->totalHours = $request->totalHours;
        $proposal->earliestStartDate = $request->earliestStartDate;
        $proposal->latestEndDate = $request->latestEndDate;
        $proposal->student_id = $user->id;
        $proposal->offer_id = $offer->id;
        $proposal->state = 1; //Not evaluated
        $proposal->creationDate = new \DateTime();
        $proposal->save();
        
        
        return redirect('/offers/'.$offer->id);
    }
    
    public function remove($id) {
        $proposal = Proposal::find($id);
        $proposal->delete();
        return redirect('/offers/'.$proposal->offer->id);
    }
    
    public function approve($id) {
        $proposal = Proposal::find($id);
        $proposal->state = 2; //approved by organization
        $proposal->save();
        return redirect('/offers/'.$proposal->offer->id);
    }
    
    public function reject($id) {
        $proposal = Proposal::find($id);
        $proposal->state = 3; //rejected by organization
        $proposal->save();
        return redirect('/offers/'.$proposal->offer->id);
    }
    public function accept($id) {
        $proposal = Proposal::find($id);
        $offer = $proposal->offer;
        
        if(!$offer->open){
            return redirect('/offers/'.$offer->id);
        }
        
        $proposal->state = 4; //accepted by student
        $proposal->save();
        if($offer->getAmountOfAcceptedProposals()>=$offer->places){
            $offer->open = false;
            $offer->save();
        }
        return redirect('/offers/'.$proposal->offer->id);
    }
    
    
    public function cancel($id) {
        $proposal = Proposal::find($id);
        $proposal->state = 5; //cancelled by student
        $proposal->save();
        return redirect('/offers/'.$proposal->offer->id);
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
