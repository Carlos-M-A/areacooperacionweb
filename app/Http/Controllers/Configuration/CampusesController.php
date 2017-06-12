<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Campus;

class CampusesController extends Controller {

    public function search(Request $request) {
        $this->validate($request, [
            'name' => 'nullable|string|max:' . config('forms.campus_name'),
            'abbreviation' => 'nullable|string|max:' . config('forms.abbreviation'),
        ]);

        //If the name and the abbreviation are empty then return all results
        if (is_null($request->name) && is_null($request->abbreviation)) {
            $faculties = Campus::all();
            return view('configuration/campuses')->with('faculties', $faculties);
        }
        //Choose that search depending de the empty fields
        if (!is_null($request->name)) {
            $faculties = Campus::where('name', 'LIKE', '%' . $request->name . '%');
            if (!is_null($request->abbreviation)) {
                $faculties->where('abbreviation', 'LIKE', '%' . $request->abbreviation . '%');
            }
        } else {
            $faculties = Campus::where('abbreviation', 'LIKE', '%' . $request->abbreviation . '%');
        }

        return view('configuration/campuses')->with('faculties', $faculties->get());
    }

}
