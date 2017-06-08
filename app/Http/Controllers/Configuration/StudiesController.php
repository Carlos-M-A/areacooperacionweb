<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study;
use App\Faculty;

class StudiesController extends Controller
{
    /**
     * Show the main screen of the studies
     * @return type
     */
    public function index() {
        $studies = Study::all();
        return view('configuration/studies')->with('studies', $studies);
    }
    
    public function search(Request $request){
        $this->validate($request, [
            'name' => 'nullable|string|max:'.config('forms.study_name'),
            'branch' => 'required|integer|min:0|max:6',
        ]);
        
        //si el name esta vacio y da igual la branch se envian todos los resultados
        if(is_null($request->name) && $request->branch == 0){
            $studies = Study::all();
            return view('configuration/studies')->with('studies', $studies);
        }
        
        //Si no se eligio ninguna branch se busca solo por el name del study
        if($request->branch == 0){
            $studies = Study::where('name', 'LIKE', '%'.$request->name.'%');
            return view('configuration/studies')->with('studies', $studies->get());
        }
        
        //Si se eligio una branch se busca dentro de esa branch los studies
        $studies = Study::where('branch', $request->branch);
        if(!is_null($request->name)){
            $studies->where('name', 'LIKE', '%'.$request->name.'%');
        }
        
        return view('configuration/studies')->with('studies', $studies->get());
    }
}
