<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'Offer';
    public $timestamps = false;
    
    public function proposals() {
        return $this->hasMany('App\Proposal', 'offer_id', 'id');
    }
}
