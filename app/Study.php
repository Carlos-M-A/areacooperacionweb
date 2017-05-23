<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $table = 'Study';
    public $timestamps = false;
  
    public function faculty() {
        return $this->belongsTo('App\Faculty', 'faculty_id', 'id');
    }
    
    /**
     * Return the state of this proposal
     * @return string The full name of the state
     */
    public function getBranchName() {
        switch ($this->branch){
            case 1:
                return 'Not evaluated';
            case 2:
                return 'Approved';
            case 3:
                return 'Rejected';
            case 4:
                return 'Accepted by student';
            case 5:
                return 'Cancelled';
        }
    }
}
