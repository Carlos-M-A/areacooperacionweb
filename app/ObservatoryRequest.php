<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservatoryRequest extends Model
{
    
    protected $table = 'ObservatoryRequest';
    public $timestamps = false;
    
    public function user() {
        return $this->belongsTo('App\User', 'id', 'id');
    }
}
