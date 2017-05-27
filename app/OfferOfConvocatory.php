<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferOfConvocatory extends Model
{
    protected $table = 'OfferOfConvocatory';
    public $timestamps = false;
    
    public function offer() {
        return $this->belongsTo('App\Offer', 'id', 'id');
    }
    
    public function convocatory() {
        return $this->belongsTo('App\Convocatory', 'convocatory_id', 'id');
    }
}
