<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\Teacher;
use App\Other;
use App\RoleChangeRequest;
use Illuminate\Support\Facades\DB;

class RoleChangeRequestController extends Controller
{
    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';
    
    
    public function showCreate() {
        $user = Auth::user();
        if (!is_null($user->roleChangeRequest)) {
            return redirect($this->redirectTo);
        }
        return view('profile/requestRoleChange');
    }

    public function create(Request $request) {
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
            'areasOfInterest' => 'required|string|max:'.config('forms.areasOfInterest'),
        ];
        
        switch ($request->role) {
            //student
            case 1:
                    $rules['study'] = 'required|integer|min:1';
                    $rules['skills'] = 'required|string|max:'.config('forms.skills');
                break;
            //Teacher
            case 2:
                    //The next rule is a regular expresion to accpet the strings
                    //with this format: 234.343.23,121
                    $rules['teachingStudiesSelected'] = 'required|string|regex:/^([0-9]+,)*([0-9]+)$/';
                    $rules['departments'] = 'required|string|max:'.config('forms.departments');
                break;
            //Other
            case 3:
                    $rules['description'] = 'required|string|max:'.config('forms.user_description');
                break;
        }
        $this->validate($request, $rules);

        $roleChangeRequest = new RoleChangeRequest();
        $roleChangeRequest->id = $user->id;
        $roleChangeRequest->currentRole = $user->role;
        $roleChangeRequest->newRole = $request->role;
        $roleChangeRequest->save();

        //This is to recycle the surname
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
                $student->save();
                break;
            case 2:
                $teacher = new Teacher;
                $teacher->id = $user->id;
                $teacher->surnames = $surnames;
                $teacher->areasOfInterest = $request->areasOfInterest;
                $teacher->departments = $request->departments;
                $teacher->save();

                $studiesWithTeaching = array_unique(explode(',', $request->teachingStudiesSelected));

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
