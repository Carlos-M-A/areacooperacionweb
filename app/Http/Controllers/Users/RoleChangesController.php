<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoleChangeRequest;
use App\Student;
use App\Teacher;
use App\Other;
use App\User;

class RoleChangesController extends Controller
{
    /**
     * Show the main screen of the role change requests
     * @return type
     */
    public function index() {
        return view('users/roleChanges');
    }
    
    public function roleChange($id) {
        $roleChangeRequest = RoleChangeRequest::find($id);
        $roleData = $this->roleData($id, $roleChangeRequest->newRole);
        
        return view('users/roleChange')->with('roleChangeRequest', $roleChangeRequest)->with('roleData', $roleData);
    }
    
    public function accept($id) {
        $user = User::find($id);
        $roleChangeRequest = RoleChangeRequest::find($id);
        $currentRoleData = $this->roleData($id, $roleChangeRequest->currentRole);
        
        $user->role = $roleChangeRequest->newRole;
        $user->save();
        
        $currentRoleData->delete();
        $roleChangeRequest->delete();
        return redirect('roleChanges');
    }
    
    public function reject($id) {
        $roleChangeRequest = RoleChangeRequest::find($id);
        $roleData = $this->roleData($id, $roleChangeRequest->currentRole);
        
        $roleChangeRequest->delete();
        $roleData->delete();
        
        return redirect('roleChanges');
    }
    
    private function roleData($id, $rol) {
        switch ($rol){
            case 1:
                return Student::find($id);
            case 2:
                return Teacher::find($id);
            case 3:
                return Other::find($id);
        }
    }
}
