<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study;
use App\Faculty;

class StudyController extends Controller
{
    
    public function study($id){
        $study = Study::find($id);
        return view('configuration/study')->with('study', $study);
    }
    
    public function changeInactive($id) {
        $study = Study::find($id);
        $study->inactive = !$study->inactive;
        $study->save();
        return redirect('studies/'.$study->id);
    }
    
    public function changeName($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:'.config('forms.study_name'),
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
        return view('configuration/createStudy');
    }
    
    public function createStudy(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:'.config('forms.study_name'),
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
