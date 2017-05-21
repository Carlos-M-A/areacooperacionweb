<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'Faculty';
    public $timestamps = false;
    
    public function studies() {
        return $this->hasMany('App\Study', 'faculty_id', 'id');
    }
}
