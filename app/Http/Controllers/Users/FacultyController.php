<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faculty;

class FacultyController extends Controller
{
    
    
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
