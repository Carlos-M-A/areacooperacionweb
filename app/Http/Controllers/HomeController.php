<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        switch ($user->role) {
            case 1:
                return redirect('offers/newOffers');
            case 2:
                return redirect('projects/myProjects');
            case 3:
                return redirect('profile');
            case 4:
                return redirect('offers/myOffers');
            case 5:
                return redirect('offers/myOffers');
            case 6:
                return redirect('users/requests');
        }
    }

}
