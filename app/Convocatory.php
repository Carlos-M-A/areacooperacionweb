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
    
    public function getAmountOfNotEvaluatedInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 1)->count();
    }
    
    public function getAmountOfAcceptedInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 2)->count();
    }

    public function getAmountOfAlternateInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 3)->count();
    }
    
    public function getAmountOfRejectedInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 4)->count();
    }

    public function getAmountOfCancelledInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 5)->count();
    }
}
