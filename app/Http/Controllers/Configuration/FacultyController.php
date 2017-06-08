<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faculty;

class FacultyController extends Controller {

    public function showCreate() {
        return view('configuration/createFaculty');
    }

    public function get($id) {
        $faculty = Faculty::find($id);
        return view('configuration/faculty')->with('faculty', $faculty);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:' . config('forms.faculty_name'),
            'city' => 'required|string|max:' . config('forms.city'),
        ]);
        $faculty = new Faculty();
        $faculty->name = $request->name;
        $faculty->city = $request->city;
        $faculty->inactive = false;
        $faculty->save();
        return redirect('faculties/' . $faculty->id);
    }

    public function changeInactive($id) {
        $faculty = Faculty::find($id);
        $faculty->inactive = !$faculty->inactive;
        $faculty->save();
        return redirect('faculties/' . $faculty->id);
    }

    public function changeName($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:' . config('forms.faculty_name'),
        ]);
        $faculty = Faculty::find($id);
        $faculty->name = $request->name;
        $faculty->save();
        return redirect('faculties/' . $faculty->id);
    }

    public function changeCity($id, Request $request) {
        $this->validate($request, [
            'city' => 'required|string|max:' . config('forms.city'),
        ]);
        $faculty = Faculty::find($id);
        $faculty->city = $request->city;
        $faculty->save();
        return redirect('faculties/' . $faculty->id);
    }

}
