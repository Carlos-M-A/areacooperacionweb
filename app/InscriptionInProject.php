<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscriptionInProject extends Model
{
    protected $table = 'InscriptionInProject';
    public $timestamps = false;
    
    public function student() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
    
    public function project() {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }
}
