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
}
