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

    /**
     * Counts the not evaluated proposals that were enrolled in this offer 
     * @return int Amount of not evaluated proposals in this convocatory
     */
    public function getAmountOfNotEvaluatedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 1)->count();
    }

    /**
     * Counts the appoved proposals that were enrolled in this offer 
     * @return int Amount of approved proposals in this convocatory
     */
    public function getAmountOfApprovedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 2)->count();
    }
    
    /**
     * Counts the rejected proposals that were enrolled in this offer 
     * @return int Amount of rejected proposals in this convocatory
     */
    public function getAmountOfRejectedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 3)->count();
    }

    /**
     * Counts the accepted (by the student) proposals that were enrolled in this offer 
     * @return int Amount of accepted proposals in this convocatory
     */
    public function getAmountOfAcceptedProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 4)->count();
    }

    /**
     * Counts the cancelled proposals that were enrolled in this offer 
     * @return int Amount of cancelled proposals in this convocatory
     */
    public function getAmountOfCancelledProposals() {
        return Proposal::where('offer_id', $this->id)->where('state', 5)->count();
    }

}
