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
                $controller = new HomeStudentController();
                break;
            case 2:
                $controller = new HomeTeacherController();
                break;
            case 3:
                $controller = new HomeOtherController();
                break;
            case 4:
                $controller = new HomeOrganizationController();
                break;
            case 5:
                $controller = new HomeCooperationAreaController();
                break;
            case 6:
                $controller = new HomeAdminController();
                break;
        }
        return $controller->index();
    }
    
}
