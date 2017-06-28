<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\RoleChangeRequest;
use App\Student;
use App\Teacher;
use App\Other;
use App\User;
use App\Project;
use App\InscriptionInProject;
use App\Inscription;
use App\Proposal;


class RoleChangeController extends Controller {

    public function get($id) {
        $roleChangeRequest = RoleChangeRequest::find($id);
        $roleData = $this->_roleData($id, $roleChangeRequest->newRole);

        return view('users/roleChange')->with('roleChangeRequest', $roleChangeRequest)->with('roleData', $roleData);
    }

    /**
     * Change the role of the project who made the role change request.
     * Remove the old data of the old role of the user.
     * @param type $id Id of the role change request
     */
    public function accept($id) {
        $user = User::find($id);
        $roleChangeRequest = RoleChangeRequest::find($id);
        $currentRoleData = $this->_roleData($id, $roleChangeRequest->currentRole);
        
        if($roleChangeRequest->currentRole == 1){
            Storage::delete($currentRoleData->urlCurriculum);
            Inscription::where('student_id', $currentRoleData->id)->where('state', 1)->delete();
            InscriptionInProject::where('student_id', $currentRoleData->id)->where('state', '!=', 2)->delete();
            Proposal::where('student_id', $currentRoleData->id)->where('state', '!=', 4)->delete();
        }
        
        if($roleChangeRequest->currentRole == 2){
            $currentRoleData->studies()->detach();
            Project::where('teacher_id', $currentRoleData->id)->where('state', '<=', 2)->delete();
        }
        
        $user->role = $roleChangeRequest->newRole;
        $user->save();
        
        $currentRoleData->delete();
        $roleChangeRequest->delete();
        return redirect('roleChanges');
    }

    public function reject($id) {
        $roleChangeRequest = RoleChangeRequest::find($id);
        $roleData = $this->_roleData($id, $roleChangeRequest->newRole);
        if($roleChangeRequest->newRole == 2){
            $roleData->studies()->detach();
        }
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
