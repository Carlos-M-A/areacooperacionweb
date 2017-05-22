<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'Organization';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id', 'id');
    }
}
