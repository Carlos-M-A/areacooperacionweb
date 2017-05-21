<?php

namespace App\Http\Controllers\Users;

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
        return view('users/studies')->with('studies', $studies);
    }
    
    public function search(Request $request){
        $this->validate($request, [
            'name' => 'nullable|string|max:100',
            'branch' => 'required|integer|min:0|max:6',
        ]);
        
        //si el name esta vacio y da igual la branch se envian todos los resultados
        if(is_null($request->name) && $request->branch == 0){
            $studies = Study::all();
            return view('users/studies')->with('studies', $studies);
        }
        
        //Si no se eligio ninguna branch se busca solo por el name del study
        if($request->branch == 0){
            $studies = Study::where('name', 'LIKE', '%'.$request->name.'%');
            return view('users/studies')->with('studies', $studies->get());
        }
        
        //Si se eligio una branch se busca dentro de esa branch los studies
        $studies = Study::where('branch', $request->branch);
        if(!is_null($request->name)){
            $studies->where('name', 'LIKE', '%'.$request->name.'%');
        }
        
        return view('users/studies')->with('studies', $studies->get());
    }
    
    public function study($id){
        $study = Study::find($id);
        return view('users/study')->with('study', $study);
    }
    
    public function changeInactive($id) {
        $study = Study::find($id);
        $study->inactive = !$study->inactive;
        $study->save();
        return redirect('studies/'.$study->id);
    }
    
    public function changeName($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:100',
        ]);
        $study = Study::find($id);
        $study->name = $request->name;
        $study->save();
        return redirect('studies/'.$study->id);
    }
    
    public function changeBranch($id, Request $request) {
        $this->validate($request, [
            'branch' => 'required|integer|min:1|max:6',
        ]);
        $study = Study::find($id);
        $study->branch = $request->branch;
        $study->save();
        return redirect('studies/'.$study->id);
    }
    
    public function changeFaculty($id, Request $request) {
        $this->validate($request, [
            'faculty' => 'required|integer|min:1',
        ]);
        $study = Study::find($id);
        $study->faculty_id = $request->faculty;
        $study->save();
        return redirect('studies/'.$study->id);
    }
    
    public function showCreateStudy() {
        return view('users/createStudy');
    }
    
    public function createStudy(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'branch' => 'required|integer|min:1|max:6',
            'faculty' => 'required|integer|min:1',
        ]);
        $study = new Study();
        $study->name = $request->name;
        $study->branch = $request->branch;
        $study->faculty_id = $request->faculty;
        $study->inactive = false;
        $study->save();
        return redirect('studies/'.$study->id);
    }
}
