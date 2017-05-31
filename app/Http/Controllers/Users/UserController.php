<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    
    public function user($id) {
        $user = User::find($id);
        return view('users/user')->with('user', $user);
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
