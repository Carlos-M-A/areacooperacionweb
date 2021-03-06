<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study;

class StudyController extends Controller {

    public function showCreate() {
        return view('configuration/createStudy');
    }

    public function get($id) {
        $study = Study::find($id);
        return view('configuration/study')->with('study', $study);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:' . config('forms.study_name'),
            'branch' => 'required|integer|min:1|max:6',
            'campus' => 'required|integer|min:1',
        ]);
        $study = new Study();
        $study->name = $request->name;
        $study->branch = $request->branch;
        $study->campus_id = $request->campus;
        $study->inactive = false;
        $study->save();
        return redirect('studies/' . $study->id);
    }

    public function changeInactive($id) {
        $study = Study::find($id);
        $study->inactive = !$study->inactive;
        $study->save();
        return redirect('studies/' . $study->id);
    }

    public function changeName($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:' . config('forms.study_name'),
        ]);
        $study = Study::find($id);
        $study->name = $request->name;
        $study->save();
        return redirect('studies/' . $study->id);
    }

    public function changeBranch($id, Request $request) {
        $this->validate($request, [
            'branch' => 'required|integer|min:1|max:6',
        ]);
        $study = Study::find($id);
        $study->branch = $request->branch;
        $study->save();
        return redirect('studies/' . $study->id);
    }

    public function changeCampus($id, Request $request) {
        $this->validate($request, [
            'campus' => 'required|integer|min:1',
        ]);
        $study = Study::find($id);
        $study->campus_id = $request->campus;
        $study->save();
        return redirect('studies/' . $study->id);
    }

}
