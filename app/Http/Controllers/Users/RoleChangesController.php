<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoleChangeRequest;
use App\Student;
use App\Teacher;
use App\Other;
use App\User;

class RoleChangesController extends Controller
{
    /**
     * Show the main screen of the role change requests
     * @return type
     */
    public function index() {
        return view('users/roleChanges');
    }
    
}
