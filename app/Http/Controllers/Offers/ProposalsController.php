<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Proposal;
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
        $offer = Offer::find($id);
        $user = Auth::user();
        
        $proposal = Proposal::where('offer_id', $offer->id)->where('student_id', $user->id)->first();
        $proposal->delete();
        return redirect('/offers/'.$offer->id);
    }
}
