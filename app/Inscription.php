<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table = 'Inscription';
    public $timestamps = false;
    
    public function convocatory() {
        return $this->belongsTo('App\Convocatory', 'convocatory_id', 'id');
    }
    
    public function student() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
}
