<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ObservatoryController extends Controller {

    protected $redirectTo = 'observatory';

    public function index() {
        return view('users/observatory');
    }

    public function acceptRequest($id) {
        $user = User::find($id);
        $user->isObservatoryMember = true;
        $user->save();
        $user->observatoryRequest->delete();
        return redirect($this->redirectTo);
    }

    public function rejectRequest($id) {
        $user = User::find($id);
        $user->isObservatoryMember = false;
        $user->save();
        $user->observatoryRequest->delete();
        return redirect($this->redirectTo);
    }

    public function removeMember($id) {
        $user = User::find($id);
        $user->isObservatoryMember = false;
        $user->save();

        switch (Auth::user()->role) {
            case 1:
                return redirect('profile');
            case 6:
                return redirect($this->redirectTo);
        }
    }

}
