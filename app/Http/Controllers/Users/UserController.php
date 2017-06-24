<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Inscription;
use App\InscriptionInProject;
use App\Proposal;
use App\Offer;
use App\Project;
use App\Http\Controllers\Offers\OfferController;

class UserController extends Controller {

    public function get($id) {
        $user = User::find($id);
        switch (Auth::user()->role){
            case 1:
            case 2:
            case 3:
            case 4:
                return view('users/user')->with('user', $user);
            case 5:
                return view('users/user')->with('user', $user);
            case 6:
                return view('users/userAsAdmin')->with('user', $user);
        }
        
    }

    public function accept($id) {
        $user = User::find($id);
        $user->accepted = true;
        $user->save();
        return redirect('users/requests');
    }

    public function reject($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('users/requests');
    }

    public function remove($id) {
        $user = User::find($id);
        
        Storage::delete($user->urlAvatar);
        
        $user->email = uniqid('', true);
        $user->idCard = uniqid('');
        $user->phone = '';
        $user->password = bcrypt(uniqid('pwRandom_'));
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->removed = true;
        $user->urlAvatar = null;
        $user->save();
        
        if(! is_null($user->roleChangeRequest)){
            $user->roleChangeRequest->delete();
        }
        if(! is_null($user->observatoryRequest)){
            $user->observatoryRequest->delete();
        }
        
        switch ($user->role){
            case 1:
                $this->_removeStudent($user->student);
                break;
            case 2:
                $this->_removeTeacher($user->teacher);
                break;
            case 3:
                $this->_removeOther($user->other);
                break;
            case 4:
                $this->_removeOrganization($user->organization);
                break;
        }
        return redirect('users/' . $user->id);
    }
    
    private function _removeStudent($student) {
        Storage::delete($student->urlCurriculum);
        Inscription::where('student_id', $student->id)->where('state', 1)->delete();
        InscriptionInProject::where('student_id', $student->id)->where('state', '!=', 2)->delete();
        Proposal::where('student_id', $student->id)->where('state', '!=', 4)->delete();
        $student->urlCurriculum = null;
        $student->areasOfInterest = '';
        $student->skills = '';
        $student->save();
        
    }
    
    private function _removeTeacher($teacher) {
        $teacher->areasOfInterest = '';
        $teacher->departments = '';
        $teacher->save();
        $teacher->studies()->detach();
        
        Project::where('teacher_id', $teacher->id)->where('state', '<=', 2)->delete();
    }
    
    private function _removeOther($other) {
        $other->areasOfInterest = '';
        $other->description = '';
        $other->save();
    }
    
    private function _removeOrganization($organization) {
        $organization->description = '';
        $organization->headquartersLocation = '';
        $organization->web = '';
        $organization->linksWithNearbyEntities = '';
        $organization->save();
        
        $offers = Offer::where('organization_id', $organization->id)->where('open', true)->get();
        $offerController = new OfferController();
        
        foreach($offers as $offer){
            $offerController->closeOffer($offer->id);
        }
    }
    
}
