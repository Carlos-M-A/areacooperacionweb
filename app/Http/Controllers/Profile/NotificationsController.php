<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller {
    
    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';

    public function changeNotificationProjects() {

        $user = Auth::user();

        $user->notificationInfoProjects = !$user->notificationInfoProjects;
        $user->save();

        return redirect($this->redirectTo);
    }

    public function changeNotificationConvocations() {

        $user = Auth::user();

        $user->notificationInfoConvocatories = !$user->notificationInfoConvocatories;
        $user->save();

        return redirect($this->redirectTo);
    }

}
