<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'Offer';
    public $timestamps = false;
    
    public function proposals() {
        return $this->hasMany('App\Proposal', 'offer_id', 'id');
    }
    
    public function organization() {
        return $this->belongsTo('App\Organization', 'organization_id', 'id');
    }
    
    public function offerOfConvocatory(){
        return $this->hasOne('App\OfferOfConvocatory', 'id');
    }
    
    public function getAcceptedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 4)->get();
    }
    
    public function getAmountOfAcceptedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 4)->count();
    }
}
