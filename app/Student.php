<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'Student';
    public $timestamps = false;

    public function study() {
        return $this->belongsTo('App\Study', 'study_id', 'id');
    }
    
    public function user() {
        return $this->belongsTo('App\User', 'id', 'id');
    }
    
    /**
     * Checks if this student has a project where he is the author. The study 
     * of the project must be the same study of the student.
     * @return boolean True if this student has a project in that he is author (project
     *                  with the same study that this student).
     *                  False if he hasn't one.
     */
    public function hasProjectAssigned() {
        $amountOfProjectsAssigned = InscriptionInProject::whereHas('project', function ($query) {
            $query->where('study_id', $this->study->id);
        })->where('state', 2)->where('student_id', $this->id)->count();
        return ($amountOfProjectsAssigned > 0);
    }
    
    /**
     * Check if this student has a accepted inscription in the convocatory
     * @param \App\Convocatory $convocatory The convocatory where the student must be enrolled
     * @return boolean True if this student has a accepted inscription. False if he hasn't one.
     */
    public function isAcceptedInConvocatory(Convocatory $convocatory) {
        $inscription = Inscription::where('convocatory_id', $convocatory->id)->where('student_id', $this->id)->first();
        if(is_null($inscription)){
            return false;
        }
        if($inscription->state == 2){
            return true;
        } else {
            return false;
        }
    }
}
