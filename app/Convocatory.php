<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convocatory extends Model
{
    protected $table = 'Convocatory';
    public $timestamps = false;
    
    public function inscriptions() {
        return $this->hasMany('App\Inscription', 'convocatory_id', 'id');
    }
}
