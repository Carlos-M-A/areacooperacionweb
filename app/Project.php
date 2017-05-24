<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    public $timestamps = false;
    
    public function offer() {
        return $this->belongsTo('App\Offer', 'offer_id', 'id');
    }
}
