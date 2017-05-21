<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeOrganizationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Muestra el home de una organizacion
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('homes/organizationHome');
    }
}
