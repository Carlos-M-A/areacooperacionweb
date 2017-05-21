<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeTeacherController extends Controller
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
     * Muestra el home del usuario con rol Docente
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('homes/teacherHome');
    }
}
