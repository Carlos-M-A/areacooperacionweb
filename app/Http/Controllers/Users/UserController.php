<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller {

    public function get($id) {
        $user = User::find($id);
        switch (Auth::user()->role){
            case 1:
            case 2:
            case 3:
            case 4:
                return view('users/user')->with('user', $user);
            case 5:
                return view('users/user')->with('user', $user);
            case 6:
                return view('users/userAsAdmin')->with('user', $user);
        }
        
    }

    public function accept($id) {
        $user = User::find($id);
        $user->accepted = true;
        $user->save();
        return redirect('users/requests');
    }

    public function reject($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('users/requests');
    }

    public function remove($id) {
        $user = User::find($id);
        $user->delete();
    }

}
