<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    protected $table = 'Other';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'id', 'id');
    }
}
