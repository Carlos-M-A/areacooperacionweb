<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutelageProposal extends Model
{
    protected $table = 'TutelageProposal';
    public $timestamps = false;
    
    public function teacher() {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }
}
