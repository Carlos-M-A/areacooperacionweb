<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeStudentController extends Controller
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
     * Muestra las el home del usuario con rol Estudiante
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('homes/studentHome');
    }
}
