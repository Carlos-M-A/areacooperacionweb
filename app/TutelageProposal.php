<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutelageProposal extends Model
{
    protected $table = 'TutelageProposal';
    public $timestamps = false;
    
    public function teacher() {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }
    
    public function project() {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }
    
    public function tutelageProposals() {
        return $this->hasMany('App\TutelageProposal', 'project_id', 'id');
    }
    
    /**
     * Return the state of this proposal
     * @return string The full name of the state
     */
    public function getStateName() {
        switch ($this->state){
            case 1:
                return 'Not evaluated';
            case 2:
                return 'Chosen';
            case 3:
                return 'Not chosen';
        }
    }
}
