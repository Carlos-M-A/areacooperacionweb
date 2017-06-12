<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\RoleChangeRequest;
use App\Student;
use App\Teacher;
use App\Other;
use App\User;

class RoleChangeController extends Controller {

    public function get($id) {
        $roleChangeRequest = RoleChangeRequest::find($id);
        $roleData = $this->_roleData($id, $roleChangeRequest->newRole);

        return view('users/roleChange')->with('roleChangeRequest', $roleChangeRequest)->with('roleData', $roleData);
    }

    public function accept($id) {
        $user = User::find($id);
        $roleChangeRequest = RoleChangeRequest::find($id);
        $currentRoleData = $this->_roleData($id, $roleChangeRequest->currentRole);

        $user->role = $roleChangeRequest->newRole;
        $user->save();

        $currentRoleData->delete();
        $roleChangeRequest->delete();
        return redirect('roleChanges');
    }

    public function reject($id) {
        $roleChangeRequest = RoleChangeRequest::find($id);
        $roleData = $this->_roleData($id, $roleChangeRequest->newRole);

        $roleChangeRequest->delete();
        $roleData->delete();

        return redirect('roleChanges');
    }

    private function _roleData($id, $role) {
        switch ($role) {
            case 1:
                return Student::find($id);
            case 2:
                return Teacher::find($id);
            case 3:
                return Other::find($id);
        }
    }

}
