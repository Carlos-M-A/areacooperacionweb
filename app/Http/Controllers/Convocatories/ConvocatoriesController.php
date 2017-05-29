<?php

namespace App\Http\Controllers\Convocatories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Convocatory;
use App\Inscription;
use Illuminate\Support\Facades\Auth;

class ConvocatoriesController extends Controller
{
    public function showCreateConvocatory() {
        return view('convocatories/createConvocatory');
    }
    
    
    public function createConvocatory(Request $request) {
        $rules = [
            'title' => 'required|string|max:100',
            'information' => 'required|string|max:100',
            'estimatedPeriod' => 'required|string|max:100',
            'urlDocumentation' => 'required|string|max:100',
            'deadline' => 'required|date',
        ];
        $this->validate($request, $rules);
        
        $convocatory = new Convocatory();
        $convocatory->title = $request->title;
        $convocatory->information = $request->information;
        $convocatory->estimatedPeriod = $request->estimatedPeriod;
        $convocatory->urlDocumentation = $request->urlDocumentation;
        $convocatory->deadline = $request->deadline;
        $convocatory->state = 1;
        $convocatory->createdDate = new \DateTime();
        $convocatory->save();
        
        return redirect('/convocatories/'.$convocatory->id);
    }
    
    public function editConvocatory($id ,Request $request) {
        $rules = [
            'title' => 'required|string|max:100',
            'information' => 'required|string|max:100',
            'estimatedPeriod' => 'required|string|max:100',
            'urlDocumentation' => 'required|string|max:100',
            'deadline' => 'required|date',
        ];
        $this->validate($request, $rules);
        
        $convocatory = Convocatory::find($id);
        
        $convocatory->title = $request->title;
        $convocatory->information = $request->information;
        $convocatory->estimatedPeriod = $request->estimatedPeriod;
        $convocatory->urlDocumentation = $request->urlDocumentation;
        $convocatory->deadline = $request->deadline;
        $convocatory->save();
        
        return redirect('/convocatories/'.$convocatory->id);
    }
    
    public function showEditConvocatory($id) {
        $convocatory = Convocatory::find($id);
        return view('convocatories/editConvocatory')->with('convocatory', $convocatory);
    }
    
    public function convocatory($id) {
        $convocatory = Convocatory::find($id);
        $user = Auth::user();
        
        switch ($user->role){
            case 1:
                $inscription = Inscription::where('student_id', $user->id)
                    ->where('convocatory_id', $convocatory->id)->first();
                if(is_null($inscription)){
                    return view('convocatories/convocatoryAsStudent')
                            ->with('convocatory', $convocatory)->with('inscription');
                } else {
                    return view('convocatories/convocatoryAsStudent')
                            ->with('convocatory', $convocatory)->with('inscription', $inscription);
                }
            case 5:
                return view('convocatories/convocatoryAsCooperationArea')->with('convocatory', $convocatory);
            default:
                return view('convocatories/convocatory')->with('convocatory', $convocatory);
        }
    }
    
    public function convocatories() {
        $convocatories = Convocatory::all();
        
        return view('convocatories/convocatories')->with('convocatories', $convocatories);
    }
    
    public function close($id) {
        $convocatory = Convocatory::find($id);
        $convocatory->state = 3; //Closed
        $convocatory->save();
        return redirect('/convocatories/'.$convocatory->id);
    }
}
