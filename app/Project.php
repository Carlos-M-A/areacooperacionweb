<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    public $timestamps = false;
    
    public function offer() {
        return $this->belongsTo('App\Offer', 'offer_id', 'id');
    }
    
    public function proposal() {
        return $this->belongsTo('App\Proposal', 'proposal_id', 'id');
    }
    
    public function inscriptionsInProject() {
        return $this->hasMany('App\InscriptionInProject', 'project_id', 'id');
    }
}
