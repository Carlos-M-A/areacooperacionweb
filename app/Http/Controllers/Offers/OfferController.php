<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Proposal;
use App\OfferOfConvocatory;
    
class OfferController extends Controller
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
            'title' => 'required|string|max:'.config('forms.offer_title'),
            'scope' => 'required|string|max:'.config('forms.scope'),
            'description' => 'required|string|max:'.config('forms.offer_description'),
            'requeriments' => 'required|string|max:'.config('forms.requeriments'),
            'workplan' => 'required|string|max:'.config('forms.workplan'),
            'schedule' => 'required|string|max:'.config('forms.schedule'),
            'totalHours' => 'required|string|max:'.config('forms.offer_totalHours'),
            'possibleStartDates' => 'required|string|max:'.config('forms.possibleStartDates'),
            'possibleEndDates' => 'required|string|max:'.config('forms.possibleEndDates'),
            'places' => 'required|integer|max:255|min:'.$minPlaces,
            'monetaryHelp' => 'required|string|max:'.config('forms.monetaryHelp'),
            'personInCharge' => 'required|string|max:'.config('forms.personInCharge'),
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
            $rules['housing'] = 'required|string|max:'.config('forms.housing');
            $rules['costs'] = 'required|string|max:'.config('forms.costs');
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
            $rules['housing'] = 'required|string|max:'.config('forms.housing');
            $rules['costs'] = 'required|string|max:'.config('forms.costs');
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
