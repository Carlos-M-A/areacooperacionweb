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
     * Return the name of the branch of knowledge of this study
     * @return string The full name of the branch
     */
    public function getBranchName() {
        switch ($this->branch){
            case 1:
                return 'Arts and Humanities';
            case 2:
                return 'Sciences';
            case 3:
                return 'Health sciences';
            case 4:
                return 'Social and legal sciences';
            case 5:
                return 'Engineering and architecture';
            case 6:
                return 'Other';
        }
    }
}
