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
    
    public function offersOfConvocatory() {
        return $this->hasMany('App\OffersOfConvocatory', 'convocatory_id', 'id');
    }
    
    /**
     * Counts the inscriptions in convocatory that are not evaluated
     * @return int Amount of not evaluated inscriptions in this convocatory
     */
    public function getAmountOfNotEvaluatedInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 1)->count();
    }
    /**
     * Counts the inscriptions in this convocatory tha are accepted
     * @return int Amount of accepted inscriptions in this convocatory
     */
    public function getAmountOfAcceptedInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 2)->count();
    }
    
    /**
     * Counts the inscriptions in this convocatory tha are marked as alternate
     * @return int Amount of alternate inscriptions in this convocatory
     */
    public function getAmountOfAlternateInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 3)->count();
    }
    
    /**
     * Counts the inscriptions in this convocatory tha are rejected
     * @return int Amount of rejected inscriptions in this convocatory
     */
    public function getAmountOfRejectedInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 4)->count();
    }

    /**
     * Counts the inscription in this convocatory tha are cancelled
     * @return int Amount of cancelled inscriptions in this convocatory
     */
    public function getAmountOfCancelledInscriptions() {
        return Inscription::where('convocatory_id', $this->id)->where('state', 5)->count();
    }
}
