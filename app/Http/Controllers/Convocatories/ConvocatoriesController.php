<?php

namespace App\Http\Controllers\Convocatories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Convocatory;
use App\Inscription;
use Illuminate\Support\Facades\Auth;

class ConvocatoriesController extends Controller
{
    
    public function convocatories() {
        $convocatories = Convocatory::all();
        
        return view('convocatories/convocatories')->with('convocatories', $convocatories);
    }
}
