<?php

namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';
    
    public function changeSubscription() {

        $user = Auth::user();

        $user->isSubscriber= !$user->isSubscriber;
        $user->save();
        
        if($user->isSubscriber)
            $this->insertSubscriber();
        else 
           $this->removeSubscriber();
        

        return redirect($this->redirectTo);
    }
    
    /**
     * Connect with the wordpress plugin that manage the subscriptions to the
     * newsletter and insert the new subscriber
     */
    private function insertSubscriber() {
        
    }
    
    /**
     * Connect with the wordpress plugin that manage the subscriptions to the
     * newsletter and remove the subscriber
     */
    private function removeSubscriber() {
        
    }
}
