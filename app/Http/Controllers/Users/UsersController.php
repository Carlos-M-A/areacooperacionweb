<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    
    public function index() {
        $users = User::where('accepted', true);
        return view('users/users')->with('users', $users->get());
    }
    
    public function search(Request $request){
        $this->validate($request, [
            'role' => 'required|integer|min:0|max:6',
            'name' => 'nullable|string|max:100',
            'idCard' => 'nullable|string|max:20',
        ]);
        
        $users = User::where('accepted', true);
        
        if($request->role!=0){
            $users->where('role', $request->role);
        }
        if(!is_null($request->name)){
            $users->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if(!is_null($request->idCard)){
            $users->where('idCard', 'LIKE', '%'.$request->idCard.'%');
        }
        
        return view('users/users')->with('users', $users->get());
    }
    
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
    
    public function registrationRequests() {
        $users = User::where('accepted', false);
        return view('users/registrationRequests')->with('users', $users->get());
    }
}
