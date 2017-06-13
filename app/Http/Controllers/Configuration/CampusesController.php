<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Campus;

class CampusesController extends Controller {

    public function search(Request $request) {
        $this->validate($request, [
            'name' => 'nullable|string|max:' . config('forms.campus_name'),
        ]);
        $request->flash();
        //If the name and the abbreviation are empty then return all results
        if (is_null($request->name)) {
            $campuses = Campus::paginate(config('constants.pagination'));
            return view('configuration/campuses')->with('campuses', $campuses);
        }
        
        $campuses = Campus::where('name', 'LIKE', '%' . $request->name . '%');
            
        return view('configuration/campuses')->with('campuses', $campuses->paginate(config('constants.pagination')));
    }

}
