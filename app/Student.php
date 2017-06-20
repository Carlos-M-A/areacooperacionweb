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
     * Return if the student has a project where he is the author. The study 
     * of the project is the same study of the student.
     * @return boolean 
     */
    public function hasProjectAssigned() {
        $amountOfProjectsAssigned = InscriptionInProject::whereHas('project', function ($query) {
            $query->where('study_id', $this->study->id);
            $query->where('state', 2);
        })->count();
        return ($amountOfProjectsAssigned > 0);
    }
    
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
