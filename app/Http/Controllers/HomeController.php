<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Home\HomeStudentController;
use App\Http\Controllers\Home\HomeTeacherController;
use App\Http\Controllers\Home\HomeOtherController;
use App\Http\Controllers\Home\HomeOrganizationController;
use App\Http\Controllers\Home\HomeCooperationAreaController;
use App\Http\Controllers\Home\HomeAdminController;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        switch($user->role){
            case 1:
                return view('homes/studentHome');
            case 2:
                return view('homes/teacherHome');
            case 3:
                return view('homes/otherHome');
            case 4:
                return view('homes/organizationHome');
            case 5:
                return view('homes/cooperationAreaHome');
            case 6:
                return view('homes/adminHome');
        }
    }
    
}
