<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Support\Facades\Auth;

class TeachingStudiesController extends Controller {

    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';

    public function insert(Request $request) {
        $this->validate($request, [
            'studyWithTeaching' => 'required|integer|min:1',
        ]);

        $teacher = Teacher::find(Auth::user()->id);
        
        foreach($teacher->studies as $study){
            if($study->id == $request->studyWithTeaching){
                return redirect($this->redirectTo);
            }
        }
        $teacher->studies()->attach($request->studyWithTeaching);
        
        return redirect($this->redirectTo);
    }

    public function remove(Request $request) {
        $this->validate($request, [
            'studyWithTeaching' => 'required|integer|min:1',
        ]);

        $teacher = Teacher::find(Auth::user()->id);
        $teacher->studies()->detach($request->studyWithTeaching);
        
        return redirect($this->redirectTo);
    }

}
