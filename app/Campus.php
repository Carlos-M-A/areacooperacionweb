<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $table = 'Campus';
    public $timestamps = false;
    
    
    public function studies() {
        return $this->hasMany('App\Study', 'campus_id', 'id');
    }
}
