<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faculty;

class FacultiesController extends Controller
{
    
    public function index() {
        $faculties = Faculty::all();
        return view('users/faculties')->with('faculties', $faculties);
    }
    
    public function search(Request $request){
        $this->validate($request, [
            'name' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);
        $faculties;
        
        //If the name and the city are empty then return all results
        if(is_null($request->name) && is_null($request->city)){
            $faculties = Faculty::all();
            return view('users/faculties')->with('faculties', $faculties);
        }
        //Choose that search depending de the empty fields
        if(!is_null($request->name)){
            $faculties = Faculty::where('name', 'LIKE', '%'.$request->name.'%');
            if(!is_null($request->city)){
                $faculties->where('city', 'LIKE', '%'.$request->city.'%');
            }
        }else{
            $faculties = Faculty::where('city', 'LIKE', '%'.$request->city.'%');
        }
        
        
        
        return view('users/faculties')->with('faculties', $faculties->get());
    }
}
