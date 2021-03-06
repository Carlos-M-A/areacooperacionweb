<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    public $timestamps = false;
    
    public function teacher() {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }
    
    public function study() {
        return $this->belongsTo('App\Study', 'study_id', 'id');
    }
    
    public function inscriptionsInProject() {
        return $this->hasMany('App\InscriptionInProject', 'project_id', 'id');
    }
    
    /**
     * Counts the inscriptions in this project that are not chosen as the inscription
     * winner to be the project's author
     * @return int Amount of inscriptions in this project that are not chosen
     */
    public function getAmountOfNotChosenInscriptions() {
        return InscriptionInProject::where('project_id', $this->id)->where('state', 1)->count();
    }
    
    /**
     * Counts the inscriptions in this project that are cancelled
     * @return int Amount of inscriptions in this project that are cancelled
     */
    public function getAmountOfCancelledInscriptions() {
        return InscriptionInProject::where('project_id', $this->id)->where('state', 3)->count();
    }
}
