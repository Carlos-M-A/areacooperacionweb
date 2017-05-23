<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'Proposal';
    public $timestamps = false;
    
    public function student() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
    
    public function offer() {
        return $this->belongsTo('App\Offer', 'offer_id', 'id');
    }
    
    /**
     * Return the state of this proposal
     * @return string The full name of the state
     */
    public function getStateName() {
        switch ($this->state){
            case 1:
                return 'Not evaluated';
            case 2:
                return 'Approved';
            case 3:
                return 'Rejected';
            case 4:
                return 'Accepted by student';
            case 5:
                return 'Cancelled';
        }
    }

}