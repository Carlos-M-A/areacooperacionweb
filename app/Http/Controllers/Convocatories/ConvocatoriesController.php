<?php

namespace App\Http\Controllers\Convocatories;

use App\Http\Controllers\Controller;
use App\Convocatory;

class ConvocatoriesController extends Controller {

    public function all() {
        $convocatories = Convocatory::paginate(config('constants.pagination'));
        return view('convocatories/convocatories')->with('convocatories', $convocatories);
    }

}
