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
    
    public function offer($id) {
        $offer = Offer::find($id);
        $user = Auth::user();
        switch ($user->role){
            case 1:
                $proposal = Proposal::where('offer_id', $offer->id)->where('student_id', $user->id)->get()->first();
                if(is_null($proposal)){
                    return view('offers/offerAsStudent')->with('offer', $offer)->with('proposal');
                } else {
                    return view('offers/offerAsStudent')->with('offer', $offer)->with('proposal', $proposal);
                }
            case 2:
                return view('offers/offer')->with('offer', $offer);
            case 3:
                return view('offers/offer')->with('offer', $offer);
            case 4:
            case 5:
                return view('offers/offerAsOrganization')->with('offer', $offer);
            case 6:
                break;
        }
        return view('offers/offer')->with('offer', $offer);
    }
    
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
    
    public function showCreateOffer() {
        $user = Auth::user();
        
        switch ($user->role){
            case 4:
                return view('offers/createOffer');
            case 5:
                return view('offers/createOfferAsCooperationArea');
        }
    }
    
    private function getOfferFieldsRules($minPlaces) {
        if($minPlaces<1){
            $minPlaces = 1;
        }
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
            'places' => 'required|integer|max:255|min:'.$minPlaces,
            'monetaryHelp' => 'required|string|max:100',
            'personInCharge' => 'required|string|max:100',
            'deadline' => 'required|date',
        ];
        return $rules;
    }
    
    private function requestToOffer($request, $offer) {
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
        $offer->monetaryHelp = $request->monetaryHelp;
        $offer->personInCharge = $request->personInCharge;
        $offer->deadline = $request->deadline;
        
        
        return $offer;
    }
    
    public function createOffer(Request $request) {
        
        $rules = $this->getOfferFieldsRules(1);
        $this->validate($request, $rules);

        $offer = $this->requestToOffer($request, new Offer());
        $offer->organization_id = Auth::user()->id;
        $offer->managedByArea = false;
        $offer->isOfferOfConvocatory = false;
        $offer->open = true;
        $offer->createdDate = new \DateTime();
        
        $offer->save();
        return redirect('/offers/'.$offer->id);
    }
    
    public function createOfferManagedByArea(Request $request) {
        $rules = $this->getOfferFieldsRules(1);
        $rules['organizationId'] = 'required|integer|min:1';
        $rules['isOfferOfConvocatory'] = 'required|boolean';
        
        if($request->isOfferOfConvocatory == true){
            $rules['convocatoryId'] = 'required|integer|min:1';
            $rules['housing'] = 'required|string|max:100';
            $rules['costs'] = 'required|string|max:100';
        }
        $this->validate($request, $rules);
        
        $offer = $this->requestToOffer($request, new Offer());
        $offer->organization_id = $request->organizationId;
        $offer->managedByArea = true;
        $offer->open = true;
        $offer->createdDate = new \DateTime();
        $offer->isOfferOfConvocatory = $request->isOfferOfConvocatory;
        $offer->save();
        
        if($request->isOfferOfConvocatory == true){
            $offersOfConvocatoryController = new OffersOfConvocatoryController();
            $offersOfConvocatoryController->createOfferOfConvocatory($request, $offer);
        }
        return redirect('/offers/'.$offer->id);
    }
    
    public function showEditOffer($id) {
        $user = Auth::user();
        $offer = Offer::find($id);
        switch ($user->role){
            case 4:
                return view('offers/editOffer')->with('offer', $offer);
            case 5:
                return view('offers/editOfferAsCooperationArea')->with('offer', $offer);
        }
    }
    
    public function editOffer($id, Request $request) {
        $offer = Offer::find($id);
        
        $rules = $this->getOfferFieldsRules($offer->placesOccupied);
        $this->validate($request, $rules);
        
        $offer = $this->requestToOffer($request, $offer);
        $offer->save();
        return redirect('/offers/'.$offer->id);
    }
    
    public function editOfferManagedByArea($id, Request $request) {
        $offer = Offer::find($id);
        
        $rules = $this->getOfferFieldsRules($offer->placesOccupied);
        $rules['organizationId'] = 'required|integer|min:1';
        $rules['isOfferOfConvocatory'] = 'required|boolean';
        
        if($request->isOfferOfConvocatory == true){
            $rules['convocatoryId'] = 'required|integer|min:1';
            $rules['housing'] = 'required|string|max:100';
            $rules['costs'] = 'required|string|max:100';
        }
        $this->validate($request, $rules);
        
        $offer = $this->requestToOffer($request, $offer);
        $offer->organization_id = $request->organizationId;
        $offer->isOfferOfConvocatory = $request->isOfferOfConvocatory;
        $offersOfConvocatoryController = new OffersOfConvocatoryController();
        $offersOfConvocatoryController->editOfferOfConvocatory($request, $offer);
        $offer->save();
        
        return redirect('/offers/'.$offer->id);
    }
    
    public function close($id) {
        $offer = Offer::find($id);
        $offer->open = false;
        $offer->save();
        
        Proposal::where('offer_id', $offer->id)->where('state', '<=', 2)->update(['state' => 3]);
        
        return redirect('/offers/'.$offer->id);
    }
}
