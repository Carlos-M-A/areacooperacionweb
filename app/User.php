<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Student;
use App\Teacher;
use App\Other;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'User';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'idCard', 'phone', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function teacher() {
        return $this->hasOne('App\Teacher', 'id');
    }
    /**
     * Return the role name of the user
     * @return string
     */
    public function getRoleName() {
        switch ($this->role){
            case 1:
                return 'Student';
            case 2:
                return 'Teacher';
            case 3:
                return 'Other';
            case 4:
                return 'Organizatión';
            case 5:
                return 'Cooperation area';
            case 6:
                return 'Admin';
        }
    }
    
    public function getNameAndSurnames() {
        switch ($this->role){
            case 1:
            case 2:
            case 3:
            case 6:
                return $this->name.', '.$this->surnames;
            default:
                return $this->name;
        }
    }
    
    public function roleChangeRequest(){
        return $this->hasOne('App\RoleChangeRequest', 'id');
    }
    
    public function observatoryRequest(){
        return $this->hasOne('App\ObservatoryRequest', 'id');
    }
    
   
}
