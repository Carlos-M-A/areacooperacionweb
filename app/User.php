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
        $name = $this->name;
        switch ($this->role){
            case 1:
                return $name.', '.Student::find($this->id)->surnames;
            case 2:
                return $name.', '.Teacher::find($this->id)->surnames;
            case 3:
                return $name.', '.Other::find($this->id)->surnames;
            default:
                return $name;
        }
    }
    
    public function roleChangeRequest(){
        return $this->hasOne('App\RoleChangeRequest', 'id');
    }
    
    public function observatoryRequest(){
        return $this->hasOne('App\ObservatoryRequest', 'id');
    }
    
   
}
