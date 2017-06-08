<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ObservatoryRequest;

class ObservatoryRequestController extends Controller {

    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';

    public function create() {
        $user = Auth::user();

        //If the user is already a member or the user has already make a request
        //then he can not make a new request
        if ($user->isObservatoryMember || !is_null($user->observatoryRequest)) {
            return redirect($this->redirectTo);
        }

        $request = new ObservatoryRequest();
        $request->id = $user->id;
        $request->save();
        
        return redirect($this->redirectTo);
    }

    public function remove() {
        $user = Auth::user();

        //If the user has already a request then the request is deleted 
        if (!is_null($user->observatoryRequest)) {
            $user->observatoryRequest->delete();
        }

        //If the user is not a member now then the function end
        if (!$user->isObservatoryMember) {
            return redirect($this->redirectTo);
        }

        $user->isObservatoryMember = false;
        $user->save();
        return redirect($this->redirectTo);
    }

}
