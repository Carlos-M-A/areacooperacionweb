<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\Teacher;
use App\Other;
use App\Organization;
use App\InscriptionInProject;

class ProfileController extends Controller {

    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';

    public function showEdit() {
        $user = Auth::user();
        switch ($user->role) {
            case 1:
                $roleData = Student::find($user->id);
                break;
            case 2:
                $roleData = Teacher::find($user->id);
                break;
            case 3:
                $roleData = Other::find($user->id);
                break;
            case 4:
            case 5:
                $roleData = Organization::find($user->id);
                break;
            case 6:
                $roleData = null;
                break;
        }
        return view('profile/editProfile')->with('role', $user->role)->with('user', $user)->with('roleData', $roleData);
    }

    public function showEditPassword() {
        return view('profile/editPassword');
    }

    /**
     * Show de profile data and his options
     *
     * @return \Illuminate\Http\Response
     */
    public function get() {
        $user = Auth::user();
        switch ($user->role) {
            case 1:
                return view('profile/studentProfile')->with('user', $user);
            case 2:
                return view('profile/teacherProfile')->with('user', $user);
            case 3:
                return view('profile/otherProfile')->with('user', $user);
            case 4:
                return view('profile/organizationProfile')->with('user', $user);
            case 5:
                return view('profile/organizationProfile')->with('user', $user);
            case 6:
                return view('profile/adminProfile')->with('user', $user);
        }
    }

    public function edit(Request $request) {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:' . config('forms.user_name'),
            'email' => 'required|string|email|unique:User,email,' . $user->id . '|max:' . config('forms.email'),
            'idCard' => 'required|string|unique:User,idCard,' . $user->id . '|max:' . config('forms.idCard'),
            'phone' => 'required|string|max:' . config('forms.phone'),
            'surnames' => 'required|string|max:' . config('forms.surnames'),
        ];

        switch ($user->role) {
            case 1:
                $rules['study'] = 'required|integer|min:1';
                $rules['areasOfInterest'] = 'required|string|max:' . config('forms.areasOfInterest');
                $rules['skills'] = 'required|string|max:' . config('forms.skills');
                break;
            case 2:
                $rules['areasOfInterest'] = 'required|string|max:' . config('forms.areasOfInterest');
                $rules['departments'] = 'required|string|max:' . config('forms.departments');
                break;
            case 3:
                $rules['areasOfInterest'] = 'required|string|max:' . config('forms.areasOfInterest');
                $rules['description'] = 'required|string|max:' . config('forms.user_description');
                break;
            case 4;
            case 5:
                $rules['description'] = 'required|string|max:' . config('forms.user_description');
                $rules['headquartersLocation'] = 'required|string|max:' . config('forms.headquartersLocation');
                $rules['web'] = 'required|url|max:' . config('forms.url');
                $rules['linksWithNearbyEntities'] = 'nullable|string|max:' . config('forms.linksWithNearbyEntities');
                break;
        }
        $this->validate($request, $rules);

        $user->name = $request->name;
        $user->surnames = $request->surnames;
        $user->email = $request->email;
        $user->idCard = $request->idCard;
        $user->phone = $request->phone;
        $user->save();

        switch ($user->role) {
            case 1:
                $student = Student::find($user->id);
                $student->areasOfInterest = $request->areasOfInterest;
                if($student->study_id != $request->study){
                    $inscriptions = InscriptionInProject::where('student_id', $student->id)->where('state', '!=', 2)->get();
                    foreach($inscriptions as $inscription2){
                        //if($inscription2->project->study_id == $inscription2->student->study_id){
                            $inscription2->delete();
                        //}
                    }
                }
                $student->study_id = $request->study;
                $student->skills = $request->skills;
                $student->save();
                break;
            case 2:
                $teacher = Teacher::find($user->id);
                $teacher->areasOfInterest = $request->areasOfInterest;
                $teacher->departments = $request->departments;
                $teacher->save();
                break;
            case 3:
                $other = Other::find($user->id);
                $other->areasOfInterest = $request->areasOfInterest;
                $other->description = $request->description;
                $other->save();
                break;
            case 4:
            case 5:
                $organization = Organization::find($user->id);
                $organization->description = $request->description;
                $organization->headquartersLocation = $request->headquartersLocation;
                $organization->web = $request->web;
                $organization->linksWithNearbyEntities = $request->linksWithNearbyEntities;
                $organization->save();
                break;
        }

        return redirect($this->redirectTo);
    }

    public function editPassword(Request $request) {
        $this->validate($request, [
            'currentPassword' => 'required|string|min:6|max:' . config('forms.password'),
            'password' => 'required|string|min:6|confirmed',
        ]);

        $currentPassword = $request->currentPassword;
        $newPassword = $request->password;
        $user = Auth::user();


        if (password_verify($currentPassword, $user->password)) {
            $user->password = bcrypt($newPassword);
            $user->save();
            return redirect($this->redirectTo);
        } else {
            return view('profile/editPassword')->with('passwordFail', 'Incorrect password');
        }
    }

}
