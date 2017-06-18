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

}