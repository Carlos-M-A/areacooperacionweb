<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{
    public function showCreateOffer() {
        return view('offers/createOffer');
    }
    
    public function createOffer(Request $request) {
            $rules = [
            'title' => 'required|string|max:100',
            'scope' => 'required|string|max:100',
            'description' => 'required|string|max:100',
            'requeriments' => 'required|string|max:100',
            'workplan' => 'required|string|max:100',
            'schedule' => 'required|string|max:100',
            'totalHours' => 'required|string|max:100',
            'possibleStartDates' => 'required|string|max:100',
            'possibleEndDates' => 'required|string|max:100',
            'places' => 'required|integer|max:255',
            'monetaryHelp' => 'required|string|max:100',
            'personInCharge' => 'required|string|max:100',
            'deadline' => 'required|date',
        ];
            
        $this->validate($request, $rules);


        $offer = new Offer();
        $offer->organization_id = Auth::user()->id;
        $offer->managementByArea = false;
        $offer->open = true;
        $offer->title = $request->title;
        $offer->scope = $request->scope;
        $offer->description = $request->description;
        $offer->requeriments = $request->requeriments;
        $offer->workplan = $request->workplan;
        $offer->schedule = $request->schedule;
        $offer->totalHours = $request->totalHours;
        $offer->possibleStartDates = $request->possibleStartDates;
        $offer->possibleEndDates = $request->possibleEndDates;
        $offer->places = $request->places;
        $offer->placesOccupied = 0;
        $offer->monetaryHelp = $request->monetaryHelp;
        $offer->personInCharge = $request->personInCharge;
        $offer->deadline = $request->deadline;
        $offer->createdDate = new \DateTime();
        $offer->save();


        return view('offers/createOffer');
    }
}
