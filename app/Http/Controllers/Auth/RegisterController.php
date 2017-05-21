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
        $rules = ['rol' => 'required|integer|max:4|min:1'];
        $rules['name'] = 'required|string|max:100';
        $rules['email'] = 'required|string|email|max:190|unique:User';
        $rules['password'] = 'required|string|min:6|confirmed';
        $rules['idCard'] = 'required|string|max:20|unique:User';
        $rules['phone'] = 'required|string|max:30';

        switch ($data['role']) {
            //student
            case 1:
                $rules['surnames'] = 'required|string|max:100';
                $rules['study'] = 'required|integer|min:1';
                $rules['areasOfInterest'] = 'required|string|max:500';
                $rules['skills'] = 'required|string|max:500';
                $rules['urlCurriculum'] = 'nullable|string';
                break;
            //Teacher
            case 2:
                $rules['surnames'] = 'required|string|max:100';
                $rules['areasOfInterest'] = 'required|string|max:500';
                //The next rule is a regular expresion to accpet the strings
                //with this format: 234.343.23,121
                $rules['teachingStudiesSelected'] = 'required|string|regex:/^([0-9]+,)*([0-9]+)$/';
                $rules['departments'] = 'required|string|max:500';
                break;
            //Other
            case 3:
                $rules['surnames'] = 'required|string|max:100';
                $rules['areasOfInterest'] = 'required|string|max:500';
                $rules['description'] = 'required|string|max:500';
            // Organization
            case 4:
                $rules['description'] = 'required|string|max:500';
                $rules['socialName'] = 'required|string|max:200';
                $rules['urlLogoImage'] = 'required|string';
                $rules['headquartersLocation'] = 'required|string|max:500';
                $rules['web'] = 'required|url|max:200';
                $rules['linksWithNearbyEntities'] = 'nullable|string|max:500';
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
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->save();



        switch ($data['rol']) {
            case 1:
                $student = new Student;
                $student->id = $user->id;
                $student->surnames = $data['surnames'];
                $student->areasOfInterest = $data['areasOfInterest'];
                $student->study_id = $data['study'];
                $student->skills = $data['study'];
                $student->urlCurriculum = $data['urlCurriculum'];
                $student->save();
                break;
            case 2:
                $teacher = new Teacher;
                $teacher->id = $user->id;
                $teacher->surnames = $data['surnames'];
                $teacher->areasOfInterest = $data['areasOfInterest'];
                $teacher->departments = $data['departments'];
                $teacher->save();

                $teachingStudies = explode(',', $data['teachingStudiesSelected']);
                $teachingStudies = array_unique($teachingStudies);
                //$teachingStudies = array_filter($teachingStudies, "greaterThan0");

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
                $other->surnames = $data['surnames'];
                $other->areasOfInterest = $data['areasOfInterest'];
                $other->description = $data['description'];
                $other->save();
                break;
            case 4:
                $organization = new Organization;
                $organization->id = $user->id;
                $organization->socialName = $data['socialName'];
                $organization->description = $data['description'];
                $organization->urlLogoImage = $data['urlLogoImage'];
                $organization->headquartersLocation = $data['headquartersLocation'];
                $organization->web = $data['web'];
                $organization->linksWithNearbyEntities = $data['linksWithNearbyEntities'];
                $organization->save();
                break;
        }
        return $user;
    }

    private function greaterThan0($var) {
        return ($var > 0);
    }

}
