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
    
    public function faculty($id){
        $faculty = Faculty::find($id);
        return view('users/faculty')->with('faculty', $faculty);
    }
    
    public function changeInactive($id) {
        $faculty = Faculty::find($id);
        $faculty->inactive = !$faculty->inactive;
        $faculty->save();
        return redirect('faculties/'.$faculty->id);
    }
    
    public function changeName($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:100',
        ]);
        $faculty = Faculty::find($id);
        $faculty->name = $request->name;
        $faculty->save();
        return redirect('faculties/'.$faculty->id);
    }
    
    public function changeCity($id, Request $request) {
        $this->validate($request, [
            'city' => 'required|string|max:100',
        ]);
        $faculty = Faculty::find($id);
        $faculty->city = $request->city;
        $faculty->save();
        return redirect('faculties/'.$faculty->id);
    }
    
    public function showCreateFaculty() {
        return view('users/createFaculty');
    }
    
    public function createFaculty(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'city' => 'required|string|max:100',
        ]);
        $faculty = new Faculty();
        $faculty->name = $request->name;
        $faculty->city = $request->city;
        $faculty->inactive = false;
        $faculty->save();
        return redirect('faculties/'.$faculty->id);
    }
}
