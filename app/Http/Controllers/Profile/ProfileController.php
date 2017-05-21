<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Student;
use App\Teacher;
use App\Other;
use App\Organization;
use App\RoleChangeRequest;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller {

    
    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';


    /**
     * Show de profile data and his options
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        switch (Auth::user()->role) {
            case 1:
                return view('profile/studentProfile');
            case 2:
                return view('profile/teacherProfile');
            case 3:
                return view('profile/otherProfile');
            case 4:
                return view('profile/organizationProfile');
            case 5:
                return view('profile/organizationProfile');
            case 6:
                return view('profile/adminProfile');
        }
    }

    public function showEdit() {
        $user = Auth::user();
        $roleData;
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
        }
        return view('profile/editProfile')->with('role', $user->role)->with('user', $user)->with('roleData', $roleData);
    }

    public function edit(Request $request) {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:190',
            Rule::unique('User')->ignore($user->email),
            'idCard' => 'required|string|max:20',
            Rule::unique('User')->ignore($user->idCard),
            'phone' => 'required|string|max:30',
        ];
        
        switch ($user->role) {
            case 1:
                    $rules['surnames'] = 'required|string|max:100';
                    $rules['study'] = 'required|integer|min:1';
                    $rules['areasOfInterest'] = 'required|string|max:500';
                    $rules['skills'] = 'required|string|max:500';
                    $rules['urlCurriculum'] = 'nullable|string';
                break;
            case 2:
                    $rules['surnames'] = 'required|string|max:100';
                    $rules['areasOfInterest'] = 'required|string|max:500';
                    $rules['departments'] = 'required|string|max:500';
                break;
            case 3:
                    $rules['surnames'] = 'required|string|max:100';
                    $rules['areasOfInterest'] = 'required|string|max:500';
                    $rules['description'] = 'required|string|max:500';
                break;
            case 4;
            case 5:
                    $rules['socialName'] = 'required|string|max:200';
                    $rules['description'] = 'required|string|max:500';
                    $rules['urlLogoImage'] = 'nullable|string';
                    $rules['headquartersLocation'] = 'required|string|max:500';
                    $rules['web'] = 'required|url|max:200';
                    $rules['linksWithNearbyEntities'] = 'nullable|string|max:500';
                break;
        }
        $this->validate($request, $rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->idCard = $request->idCard;
        $user->phone = $request->phone;
        $user->save();

        switch ($user->role) {
            case 1:
                $student = Student::find($user->id);
                $student->surnames = $request->surnames;
                $student->areasOfInterest = $request->areasOfInterest;
                $student->study_id = $request->study;
                $student->skills = $request->skills;
                $student->urlCurriculum = $request->urlCurriculum;
                $student->save();
                break;
            case 2:
                $teacher = Teacher::find($user->id);
                $teacher->surnames = $request->surnames;
                $teacher->areasOfInterest = $request->areasOfInterest;
                $teacher->departments = $request->departments;
                $teacher->save();
                break;
            case 3:
                $other = Other::find($user->id);
                $other->surnames = $request->surnames;
                $other->areasOfInterest = $request->areasOfInterest;
                $other->description = $request->description;
                $other->save();
                break;
            case 4:
            case 5:
                $organization = Organization::find($user->id);
                $organization->socialName = $request->socialName;
                $organization->description = $request->description;
                $organization->urlLogoImage = $request->urlLogoImage;
                $organization->headquartersLocation = $request->headquartersLocation;
                $organization->web = $request->web;
                $organization->linksWithNearbyEntities = $request->linksWithNearbyEntities;
                $organization->save();
                break;
        }

        return redirect($this->redirectTo);
    }

    public function showEditPassword() {
        return view('profile/editPassword');
    }

    public function editPassword(Request $request) {
        $this->validate($request, [
            'currentPassword' => 'required|string|min:6',
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

    public function showRequestRoleChange() {
        $user = Auth::user();
        if (!is_null($user->roleChangeRequest)) {
            return $this->index();
        }

        return view('profile/requestRoleChange');
    }

    public function requestRoleChange(Request $request) {
        $user = Auth::user();
        //The request about the same role is not allowed
        if ($user->role == $request->role || $user->role > 3) {
            return redirect($this->redirectTo);
        }
        //The user can not make a request if he already has a request
        if (!is_null($user->roleChangeRequest)) {
            return redirect($this->redirectTo);
        }


        $rules = [
            'role' => 'required|integer|max:3|min:1',
            'areasOfInterest' => 'required|string|max:500',
        ];
        
        switch ($request->role) {
            //student
            case 1:
                    $rules['study'] = 'required|integer|min:1';
                    $rules['skills'] = 'required|string|max:500';
                    $rules['urlCurriculum'] = 'nullable|string';
                break;
            //Teacher
            case 2:
                    //The next rule is a regular expresion to accpet the strings
                    //with this format: 234.343.23,121
                    $rules['teachingStudiesSelected'] = 'required|string|regex:/^([0-9]+,)*([0-9]+)$/';
                    $rules['departments'] = 'required|string|max:500';
                break;
            //Other
            case 3:
                    $rules['description'] = 'required|string|max:500';
                break;
        }
        $this->validate($request, $rules);

        $roleChangeRequest = new RoleChangeRequest();
        $roleChangeRequest->id = $user->id;
        $roleChangeRequest->currentRole = $user->role;
        $roleChangeRequest->newRole = $request->role;
        $roleChangeRequest->save();

        //This is to recycle the surname
        $surnames;
        switch ($user->role) {
            case 1:
                $surnames = Student::find($user->id)->surnames;
                break;
            case 2:
                $surnames = Teacher::find($user->id)->surnames;
                break;
            case 3:
                $surnames = Other::find($user->id)->surnames;
                break;
        }

        switch ($request->role) {
            case 1:
                $student = new Student;
                $student->id = $user->id;
                $student->surnames = $surnames;
                $student->areasOfInterest = $request->areasOfInterest;
                $student->study_id = $request->study;
                $student->skills = $request->skills;
                $student->urlCurriculum = $request->urlCurriculum;
                $student->save();
                break;
            case 2:
                $teacher = new Teacher;
                $teacher->id = $user->id;
                $teacher->surnames = $surnames;
                $teacher->areasOfInterest = $request->areasOfInterest;
                $teacher->departments = $request->departments;
                $teacher->save();

                $studiesWithTeaching = explode(',', $request->teachingStudiesSelected);
                $studiesWithTeaching = array_unique($studiesWithTeaching);
                //$studiesWithTeaching = array_filter($studiesWithTeaching, "greaterThan0");

                foreach ($studiesWithTeaching as $estudioId) {
                    DB::table('Study_Teacher')->insert([
                        'teacher_id' => $user->id,
                        'study_id' => $estudioId,
                    ]);
                }

                break;
            case 3:
                $other = new Other;
                $other->id = $user->id;
                $other->surnames = $surnames;
                $other->areasOfInterest = $request->areasOfInterest;
                $other->description = $request->description;
                $other->save();
                break;
        }
        return redirect($this->redirectTo);
    }

}
