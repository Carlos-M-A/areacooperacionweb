<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faculty;

class FacultiesController extends Controller {

    public function search(Request $request) {
        $this->validate($request, [
            'name' => 'nullable|string|max:' . config('forms.faculty_name'),
            'city' => 'nullable|string|max:' . config('forms.city'),
        ]);

        //If the name and the city are empty then return all results
        if (is_null($request->name) && is_null($request->city)) {
            $faculties = Faculty::all();
            return view('configuration/faculties')->with('faculties', $faculties);
        }
        //Choose that search depending de the empty fields
        if (!is_null($request->name)) {
            $faculties = Faculty::where('name', 'LIKE', '%' . $request->name . '%');
            if (!is_null($request->city)) {
                $faculties->where('city', 'LIKE', '%' . $request->city . '%');
            }
        } else {
            $faculties = Faculty::where('city', 'LIKE', '%' . $request->city . '%');
        }

        return view('configuration/faculties')->with('faculties', $faculties->get());
    }

}
