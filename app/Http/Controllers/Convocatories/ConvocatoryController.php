<?php

namespace App\Http\Controllers\Convocatories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Convocatory;
use App\Inscription;
use Illuminate\Support\Facades\Auth;

class ConvocatoryController extends Controller {

    public function showCreate() {
        return view('convocatories/createConvocatory');
    }

    public function showEdit($id) {
        $convocatory = Convocatory::find($id);
        return view('convocatories/editConvocatory')->with('convocatory', $convocatory);
    }

    public function get($id, Request $request) {
        $convocatory = Convocatory::find($id);
        $user = Auth::user();

        switch ($user->role) {
            case 1:
                $inscription = Inscription::where('student_id', $user->id)
                                ->where('convocatory_id', $convocatory->id)->first();
                if (is_null($inscription)) {
                    return view('convocatories/convocatoryAsStudent')
                                    ->with('convocatory', $convocatory)->with('inscription');
                } else {
                    return view('convocatories/convocatoryAsStudent')
                                    ->with('convocatory', $convocatory)->with('inscription', $inscription);
                }
            case 5:
                $this->validate($request, [
                    'stateOfInscriptions' => 'nullable|integer|min:1|max:5',
                ]);
                $state = 1;
                if(!is_null($request->stateOfInscriptions)){
                    $state = $request->stateOfInscriptions;
                }
                $request->flash();
                
                $inscriptions = Inscription::where('convocatory_id', $convocatory->id)->where('state', $state)->paginate(config('constants.pagination'));
                return view('convocatories/convocatoryAsCooperationArea')->with('convocatory', $convocatory)->with('inscriptions', $inscriptions);
            default:
                return view('convocatories/convocatory')->with('convocatory', $convocatory);
        }
    }

    public function create(Request $request) {
        $this->_validateData($request);

        $convocatory = new Convocatory();
        $this->_requestToConvocatory($request, $convocatory);
        $convocatory->state = 1;
        $convocatory->createdDate = new \DateTime();
        $convocatory->save();

        return redirect('/convocatories/' . $convocatory->id);
    }

    public function edit($id, Request $request) {
        $this->_validateData($request);

        $convocatory = Convocatory::find($id);
        $this->_requestToConvocatory($request, $convocatory);
        $convocatory->save();

        return redirect('/convocatories/' . $convocatory->id);
    }

    public function close($id) {
        $convocatory = Convocatory::find($id);
        $convocatory->state = 3; //Closed
        $convocatory->save();
        return redirect('/convocatories/' . $convocatory->id);
    }

    private function _validateData(Request $request) {
        $rules = [
            'title' => 'required|string|max:' . config('forms.convocatory_title'),
            'information' => 'required|string|max:' . config('forms.information'),
            'estimatedPeriod' => 'required|string|max:' . config('forms.estimatedPeriod'),
            'urlDocumentation' => 'required|url',
            'deadline' => 'required|date|after:today',
        ];
        $this->validate($request, $rules);
    }
    
    private function _requestToConvocatory(Request $request, Convocatory $convocatory) {
        $convocatory->title = $request->title;
        $convocatory->information = $request->information;
        $convocatory->estimatedPeriod = $request->estimatedPeriod;
        $convocatory->urlDocumentation = $request->urlDocumentation;
        $convocatory->deadline = $request->deadline;
    }
}
