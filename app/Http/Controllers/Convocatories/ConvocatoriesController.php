<?php

namespace App\Http\Controllers\Convocatories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Convocatory;

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
    
    public function convocatory($id) {
        $convocatory = Convocatory::find($id);
        
        return view('convocatories/convocatory')->with('convocatory', $convocatory);
    }
    
    public function convocatories() {
        $convocatories = Convocatory::all();
        
        return view('convocatories/convocatories')->with('convocatories', $convocatories);
    }
}
