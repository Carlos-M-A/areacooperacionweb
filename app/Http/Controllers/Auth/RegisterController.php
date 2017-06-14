<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DateTime;
use App\Student;
use App\Organization;
use App\Teacher;
use App\Other;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        $rules['role'] = 'required|integer|max:4|min:1';
        $rules['name'] = 'required|string|max:'.config('forms.user_name');
        $rules['email'] = 'required|string|email|unique:User|max:'.config('forms.email');
        $rules['password'] = 'required|string|min:6|confirmed|max:'.config('forms.password');
        $rules['idCard'] = 'required|string|unique:User|max:'.config('forms.idCard');
        $rules['phone'] = 'required|string|max:'.config('forms.phone');
        $rules['surnames'] = 'required|string|max:'.config('forms.surnames');

        switch ($data['role']) {
            //student
            case 1:
                $rules['study'] = 'required|integer|min:1';
                $rules['areasOfInterest'] = 'required|string|max:'.config('forms.areasOfInterest');
                $rules['skills'] = 'required|string|max:'.config('forms.skills');
                break;
            //Teacher
            case 2:
                $rules['areasOfInterest'] = 'required|string|max:'.config('forms.areasOfInterest');
                //The next rule is a regular expresion to accpet the strings
                //with this format: 234.343.23,121
                $rules['teachingStudiesSelected'] = 'required|string|regex:/^([0-9]+,)*([0-9]+)$/';
                $rules['departments'] = 'required|string|max:'.config('forms.departments');
                break;
            //Other
            case 3:
                $rules['areasOfInterest'] = 'required|string|max:'.config('forms.areasOfInterest');
                $rules['description'] = 'required|string|max:'.config('forms.user_description');
                break;
            // Organization
            case 4:
                $rules['description'] = 'required|string|max:'.config('forms.user_description');
                $rules['headquartersLocation'] = 'required|string|max:'.config('forms.headquartersLocation');
                $rules['web'] = 'required|url|max:'.config('forms.url');
                $rules['linksWithNearbyEntities'] = 'nullable|string|max:'.config('forms.linksWithNearbyEntities');
                break;
        }
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {

        $user = new User;
        $user->name = $data['name'];
        $user->surnames = $data['surnames'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->idCard = $data['idCard'];
        $user->phone = $data['phone'];
        $user->role = $data['role'];
        $user->accepted = false;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new DateTime();
        $user->createdDate = new DateTime();
        $user->save();



        switch ($data['role']) {
            case 1:
                $student = new Student;
                $student->id = $user->id;
                $student->areasOfInterest = $data['areasOfInterest'];
                $student->study_id = $data['study'];
                $student->skills = $data['study'];
                $student->save();
                break;
            case 2:
                $teacher = new Teacher;
                $teacher->id = $user->id;
                $teacher->areasOfInterest = $data['areasOfInterest'];
                $teacher->departments = $data['departments'];
                $teacher->save();

                $teachingStudies = array_unique(explode(',', $data['teachingStudiesSelected']));
                foreach ($teachingStudies as $studyID) {
                    DB::table('Study_Teacher')->insert([
                        'teacher_id' => $user->id,
                        'study_id' => $studyID,
                    ]);
                }
                break;
            case 3:
                $other = new Other;
                $other->id = $user->id;
                $other->areasOfInterest = $data['areasOfInterest'];
                $other->description = $data['description'];
                $other->save();
                break;
            case 4:
                $organization = new Organization;
                $organization->id = $user->id;
                $organization->description = $data['description'];
                $organization->headquartersLocation = $data['headquartersLocation'];
                $organization->web = $data['web'];
                $organization->linksWithNearbyEntities = $data['linksWithNearbyEntities'];
                $organization->save();
                break;
        }
        return $user;
    }

}
