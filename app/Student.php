<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'Student';
    public $timestamps = false;

    public function study() {
        return $this->belongsTo('App\Study', 'study_id', 'id');
    }
    
    public function user() {
        return $this->belongsTo('App\User', 'id', 'id');
    }
}
