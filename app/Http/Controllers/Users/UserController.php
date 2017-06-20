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
        
        $user->email = uniqid('', true);
        $user->idCard = uniqid('');
        $user->phone = '';
        $user->password = bcrypt(uniqid('pwRandom_'));
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->removed = true;
        $user->save();
        
        switch ($user->role){
            case 1:
                $user->student->areasOfInterest = '';
                $user->student->skills = '';
                $user->student->save();
                break;
            case 2:
                $user->teacher->areasOfInterest = '';
                $user->teacher->departments = '';
                $user->teacher->save();
                $user->teacher->studies()->detach();
                
                break;
            case 3:
                $user->other->areasOfInterest = '';
                $user->other->description = '';
                $user->other->save();
                break;
            case 4:
                $user->organization->description = '';
                $user->organization->save();
                break;
        }
    }
    
}
