<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $table = 'Study';
    public $timestamps = false;
  
    public function faculty() {
        return $this->belongsTo('App\Faculty', 'faculty_id', 'id');
    }
}
