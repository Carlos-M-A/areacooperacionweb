<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleChangeRequest extends Model
{
    protected $table = 'RoleChangeRequest';
    public $timestamps = false;
    
    public function user() {
        return $this->belongsTo('App\User', 'id', 'id');
    }
}
