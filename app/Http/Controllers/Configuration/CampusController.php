
<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Campus;

class CampusController extends Controller {

    public function showCreate() {
        return view('configuration/createCampus');
    }

    public function get($id) {
        $campus = Campus::find($id);
        return view('configuration/campus')->with('campus', $campus);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:' . config('forms.campus_name'),
            'abbreviation' => 'required|string|max:' . config('forms.abbreviation'),
        ]);
        $campus = new Campus();
        $campus->name = $request->name;
        $campus->abbreviation = $request->abbreviation;
        $campus->inactive = false;
        $campus->save();
        return redirect('campuses/' . $campus->id);
    }

    public function changeInactive($id) {
        $campus = Campus::find($id);
        $campus->inactive = !$campus->inactive;
        $campus->save();
        return redirect('campuses/' . $campus->id);
    }

    public function changeName($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:' . config('forms.campus_name'),
        ]);
        $campus = Campus::find($id);
        $campus->name = $request->name;
        $campus->save();
        return redirect('campuses/' . $campus->id);
    }

    public function changeAbbreviation($id, Request $request) {
        $this->validate($request, [
            'abbreviation' => 'required|string|max:' . config('forms.abbreviation'),
        ]);
        $campus = Campus::find($id);
        $campus->abbreviation = $request->abbreviation;
        $campus->save();
        return redirect('campuses/' . $campus->id);
    }

}
