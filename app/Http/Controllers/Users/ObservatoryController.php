<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;


class ObservatoryController extends Controller {

    protected $redirectTo = 'observatory';

    public function index(Request $request) {
        $this->validate($request, [
            'ask' => 'required|integer|min:1|max:2',
        ]);
        $request->flash();
        
        if($request->ask == 1){ // requests to observatory
            $users = User::has('observatoryRequest')->paginate(config('constants.pagination'));
        } else { // members of observatory
            $users = User::where('isObservatoryMember', true)->paginate(config('constants.pagination'));
        }
        
        return view('users/observatory')->with('users', $users);
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
