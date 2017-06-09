<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model {

    protected $table = 'Offer';
    public $timestamps = false;

    public function proposals() {
        return $this->hasMany('App\Proposal', 'offer_id', 'id');
    }

    public function organization() {
        return $this->belongsTo('App\Organization', 'organization_id', 'id');
    }

    public function offerOfConvocatory() {
        return $this->hasOne('App\OfferOfConvocatory', 'id');
    }

    public function getAmountOfNotEvaluatedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 1)->count();
    }

    public function getAmountOfApprovedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 2)->count();
    }
    
    public function getAmountOfRejectedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 3)->count();
    }

    public function getAmountOfAcceptedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 4)->count();
    }

    public function getAmountOfCancelledProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 5)->count();
    }

}
