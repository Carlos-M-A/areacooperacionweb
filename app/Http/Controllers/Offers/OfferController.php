<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use App\Proposal;

class OfferController extends Controller {

    public function showCreate() {
        $user = Auth::user();

        switch ($user->role) {
            case 4:
                return view('offers/createOffer');
            case 5:
                return view('offers/createOfferAsCooperationArea');
        }
    }

    public function showEdit($id) {
        $user = Auth::user();
        $offer = Offer::find($id);
        switch ($user->role) {
            case 4:
                return view('offers/editOffer')->with('offer', $offer);
            case 5:
                return view('offers/editOfferAsCooperationArea')->with('offer', $offer);
        }
    }

    public function get($id, Request $request) {
        $offer = Offer::find($id);
        $user = Auth::user();
        switch ($user->role) {
            case 1:
                $proposal = Proposal::where('offer_id', $offer->id)->where('student_id', $user->id)->get()->first();
                if (is_null($proposal)) {
                    return view('offers/offerAsStudent')->with('offer', $offer)->with('proposal');
                } else {
                    return view('offers/offerAsStudent')->with('offer', $offer)->with('proposal', $proposal);
                }
            case 4:
            case 5:
                $this->validate($request, [
                    'stateOfProposals' => 'nullable|integer|min:1|max:5',
                ]);
                $state = 1;
                if(!is_null($request->stateOfProposals)){
                    $state = $request->stateOfProposals;
                }
                $request->flash();
                
                $proposals = Proposal::where('offer_id', $offer->id)->where('state', $state)->paginate(config('constants.pagination'));
                return view('offers/offerAsOrganization')->with('offer', $offer)->with('proposals', $proposals);
            default:
                return view('offers/offer')->with('offer', $offer);
        }
        return view('offers/offer')->with('offer', $offer);
    }

    public function create(Request $request) {
        $rules = $this->_getOfferFieldsRules(1);
        $this->validate($request, $rules);

        $offer = new Offer();
        $this->_requestToOffer($request, $offer);
        $offer->organization_id = Auth::user()->id;
        $offer->managedByArea = false;
        $offer->isOfferOfConvocatory = false;
        $offer->open = true;
        $offer->createdDate = new \DateTime();

        $offer->save();
        return redirect('/offers/' . $offer->id);
    }

    public function createOfferManagedByArea(Request $request) {
        $rules = $this->_getOfferFieldsRules(1);
        $rules['organizationId'] = 'required|integer|min:1';
        $rules['isOfferOfConvocatory'] = 'required|boolean';

        if ($request->isOfferOfConvocatory == true) {
            $rules['convocatoryId'] = 'required|integer|min:1';
            $rules['housing'] = 'required|string|max:' . config('forms.housing');
            $rules['costs'] = 'required|string|max:' . config('forms.costs');
        }
        $this->validate($request, $rules);

        $offer = new Offer();
        $this->_requestToOffer($request, $offer);
        $offer->organization_id = $request->organizationId;
        $offer->managedByArea = true;
        $offer->open = true;
        $offer->createdDate = new \DateTime();
        $offer->isOfferOfConvocatory = $request->isOfferOfConvocatory;
        $offer->save();

        if ($request->isOfferOfConvocatory == true) {
            $offerOfConvocatoryController = new OfferOfConvocatoryController();
            $offerOfConvocatoryController->createOfferOfConvocatory($request, $offer);
        }
        return redirect('/offers/' . $offer->id);
    }

    public function edit($id, Request $request) {
        $offer = Offer::find($id);

        $rules = $this->_getOfferFieldsRules($offer->placesOccupied);
        $this->validate($request, $rules);

        $this->_requestToOffer($request, $offer);
        $offer->save();
        return redirect('/offers/' . $offer->id);
    }

    public function editOfferManagedByArea($id, Request $request) {
        $offer = Offer::find($id);

        $rules = $this->_getOfferFieldsRules($offer->placesOccupied);
        $rules['organizationId'] = 'required|integer|min:1';
        $rules['isOfferOfConvocatory'] = 'required|boolean';

        if ($request->isOfferOfConvocatory == true) {
            $rules['convocatoryId'] = 'required|integer|min:1';
            $rules['housing'] = 'required|string|max:' . config('forms.housing');
            $rules['costs'] = 'required|string|max:' . config('forms.costs');
        }
        $this->validate($request, $rules);

        $this->_requestToOffer($request, $offer);
        $offer->organization_id = $request->organizationId;
        $offer->isOfferOfConvocatory = $request->isOfferOfConvocatory;
        $offerOfConvocatoryController = new OfferOfConvocatoryController();
        $offerOfConvocatoryController->editOfferOfConvocatory($request, $offer);
        $offer->save();

        return redirect('/offers/' . $offer->id);
    }

    public function close($id) {
        $this->closeOffer($id);
        $offer = Offer::find($id);
        return redirect('/offers/' . $offer->id);
    }
    
    public function closeOffer($id) {
        $offer = Offer::find($id);
        $offer->open = false;
        $offer->save();

        Proposal::where('offer_id', $offer->id)->where('state', '<=', 2)->update(['state' => 3]);
    }

    private function _getOfferFieldsRules($minPlaces) {
        if ($minPlaces < 1) {
            $minPlaces = 1;
        }
        $rules = [
            'title' => 'required|string|max:' . config('forms.offer_title'),
            'scope' => 'required|string|max:' . config('forms.scope'),
            'description' => 'required|string|max:' . config('forms.offer_description'),
            'requeriments' => 'required|string|max:' . config('forms.requeriments'),
            'workplan' => 'required|string|max:' . config('forms.workplan'),
            'workplace' => 'required|string|max:' . config('forms.workplace'),
            'schedule' => 'required|string|max:' . config('forms.schedule'),
            'totalHours' => 'required|string|max:' . config('forms.offer_totalHours'),
            'possibleStartDates' => 'required|string|max:' . config('forms.possibleStartDates'),
            'possibleEndDates' => 'required|string|max:' . config('forms.possibleEndDates'),
            'places' => 'required|integer|max:255|min:' . $minPlaces,
            'monetaryHelp' => 'required|string|max:' . config('forms.monetaryHelp'),
            'personInCharge' => 'required|string|max:' . config('forms.personInCharge'),
            'deadline' => 'required|date|after:today',
        ];
        return $rules;
    }

    private function _requestToOffer($request, $offer) {
        $offer->title = $request->title;
        $offer->scope = $request->scope;
        $offer->description = $request->description;
        $offer->requeriments = $request->requeriments;
        $offer->workplan = $request->workplan;
        $offer->workplace = $request->workplace;
        $offer->schedule = $request->schedule;
        $offer->totalHours = $request->totalHours;
        $offer->possibleStartDates = $request->possibleStartDates;
        $offer->possibleEndDates = $request->possibleEndDates;
        $offer->places = $request->places;
        $offer->monetaryHelp = $request->monetaryHelp;
        $offer->personInCharge = $request->personInCharge;
        $offer->deadline = $request->deadline;
    }

}
