<?php

namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class SubscriptionController extends Controller
{
    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';
    
    /**
     * Change the subscription state of the project. If is active the subscription will be deactivated.
     * If is inactive the subscription will be activated
     * @return 
     */
    public function changeSubscription() {

        if(! config('app.newsletter_active')){
            return redirect($this->redirectTo);
        }
        $user = Auth::user();

        $user->isSubscriber = !$user->isSubscriber;
        $user->save();
        
        if($user->isSubscriber){
            $this->_insertSubscriber($user);
        }
        else{ 
           $this->_removeSubscriber($user);
        }

        return redirect($this->redirectTo);
    }
    
    /**
     * Connect with the wordpress plugin that manage the subscriptions to the
     * newsletter and insert the new subscriber
     */
    private function _insertSubscriber(User $user) {
        $date = new \DateTime();
        $values = [$user->name, $user->email, 'Confirmed', $date, '0', 'Public', 'noGroup'];
        DB::insert('insert into wp_es_emaillist (es_email_name, es_email_mail, '
                . 'es_email_status, es_email_created, es_email_viewcount, es_email_group, es_email_guid) values (?, ?, ?, ?, ?, ?, ?)', $values);
    }
    
    /**
     * Connect with the wordpress plugin that manage the subscriptions to the
     * newsletter and remove the subscriber
     */
    private function _removeSubscriber(User $user) {
        DB::delete('delete from wp_es_emaillist where es_email_mail LIKE ?', [$user->email]);
    }
}
