<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $table = 'Study';
    public $timestamps = false;
  
    public function campus() {
        return $this->belongsTo('App\Campus', 'campus_id', 'id');
    }
}
