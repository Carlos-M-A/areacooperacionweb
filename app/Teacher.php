<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'Teacher';
    public $timestamps = false;

    
    public function studies() {
       
        return $this->belongsToMany('App\Study', 'Study_Teacher', 'teacher_id', 'study_id');
        
    }
    
}
