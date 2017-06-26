<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study;

class StudiesController extends Controller {

    public function search(Request $request) {
        $this->validate($request, [
            'name' => 'nullable|string|max:' . config('forms.study_name'),
            'branch' => 'required|integer|min:0|max:6',
        ]);
        $request->flash();
        
        //search all studies
        if (is_null($request->name) && $request->branch == 0) {
            $studies = Study::orderBy('name', 'asc')->paginate(config('constants.pagination'));
            return view('configuration/studies')->with('studies', $studies);
        }

        //search studies by name
        if ($request->branch == 0) {
            $studies = Study::where('name', 'LIKE', '%' . $request->name . '%')->orderBy('name', 'asc');
            return view('configuration/studies')->with('studies', $studies->paginate(config('constants.pagination')));
        }

        //search studies by name and branch
        $studies = Study::where('branch', $request->branch)->orderBy('name', 'asc');
        if (!is_null($request->name)) {
            $studies->where('name', 'LIKE', '%' . $request->name . '%');
        }

        return view('configuration/studies')->with('studies', $studies->paginate(config('constants.pagination')));
    }

}
