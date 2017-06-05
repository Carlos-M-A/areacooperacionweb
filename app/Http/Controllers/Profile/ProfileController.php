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
            'name' => 'required|string|max:'.config('forms.user_name'),
            'email' => 'required|string|email|max:'.config('forms.email'),
            Rule::unique('User')->ignore($user->email),
            'idCard' => 'required|string|max:'.config('forms.idCard'),
            Rule::unique('User')->ignore($user->idCard),
            'phone' => 'required|string|max:'.config('forms.phone'),
            'urlAvatar' => 'nullable|image|dimensions:max_width=256,max_height=256,ratio=1',
        ];
        
        switch ($user->role) {
            case 1:
                    $rules['surnames'] = 'required|string|max:'.config('forms.surnames');
                    $rules['study'] = 'required|integer|min:1';
                    $rules['areasOfInterest'] = 'required|string|max:'.config('forms.areasOfInterest');
                    $rules['skills'] = 'required|string|max:'.config('forms.skills');
                    $rules['urlCurriculum'] = 'nullable|file|mimes:pdf';
                break;
            case 2:
                    $rules['surnames'] = 'required|string|max:'.config('forms.surnames');
                    $rules['areasOfInterest'] = 'required|string|max:'.config('forms.areasOfInterest');
                    $rules['departments'] = 'required|string|max:'.config('forms.departments');
                break;
            case 3:
                    $rules['surnames'] = 'required|string|max:'.config('forms.surnames');
                    $rules['areasOfInterest'] = 'required|string|max:'.config('forms.areasOfInterest');
                    $rules['description'] = 'required|string|max:'.config('forms.user_description');
                break;
            case 4;
            case 5:
                    $rules['socialName'] = 'required|string|max:'.config('forms.socialName');
                    $rules['description'] = 'required|string|max:'.config('forms.user_description');
                    $rules['headquartersLocation'] = 'required|string|max:'.config('forms.headquartersLocation');
                    $rules['web'] = 'required|url|max:'.config('forms.url');
                    $rules['linksWithNearbyEntities'] = 'nullable|string|max:'.config('forms.linksWithNearbyEntities');
                break;
        }
        $this->validate($request, $rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->idCard = $request->idCard;
        $user->phone = $request->phone;
        if($request->hasFile('urlAvatar')){
                    $user->urlAvatar = $request->urlAvatar->store('images');
                }
        $user->save();

        switch ($user->role) {
            case 1:
                $student = Student::find($user->id);
                $student->surnames = $request->surnames;
                $student->areasOfInterest = $request->areasOfInterest;
                $student->study_id = $request->study;
                $student->skills = $request->skills;
                if($request->hasFile('urlCurriculum')){
                    $student->urlCurriculum = $request->urlCurriculum->store('curriculums');
                }
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
            'currentPassword' => 'required|string|min:6|max:'.config('forms.password'),
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
