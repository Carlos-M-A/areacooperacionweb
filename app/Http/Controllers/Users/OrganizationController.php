<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\User;
use App\Organization;

class OrganizationController extends Controller {
    
    public function organization($id) {
        $organization = Organization::find($id);
        return view('users/organization')->with('organization', $organization);
    }
    
    public function showRegisterOrganization() {
        return view('users/registerOrganization');
    }

    //
    public function registerOrganization(Request $request) {
        $this->validateData($request, 0);

        $user = new User;
        $this->requestToUser($request, $user);
        //Makes a random password
        $user->password = bcrypt(uniqid('pwRandom_'));
        $user->role = 4;
        $user->accepted = true;
        $user->isObservatoryMember = false;
        $user->isSubscriber = false;
        $user->notificationInfoConvocatories = false;
        $user->notificationInfoProjects = false;
        $user->lastConnectionDate = new \DateTime();
        $user->createdDate = new \DateTime();
        $user->save();

        $organization = new Organization;
        $organization->id = $user->id;
        $this->requestToOrganization($request, $organization);
        $organization->save();

        return redirect('users/'.$user->id);
    }
    
    public function showEditOrganization($id) {
        $user = User::find($id);
        $organization = Organization::find($id);
        return view('users/editOrganization')->with('organization', $organization)->with('user', $user);
    }

    
    public function editOrganization($id, Request $request) {
        $user = User::find($id);
        $organization = Organization::find($id);

        $this->validateData($request, $user->id);

        $this->requestToUser($request, $user);
        $user->save();

        $this->requestToOrganization($request, $organization);
        $organization->save();

        return redirect('users/'.$user->id);
    }

    private function validateData(Request $request, $idToIgnore){
        $rules = [
            'name' => 'required|string|max:'.config('forms.user_name'),
            'email' => 'required|string|email|unique:User,email,'.$idToIgnore.'|max:'.config('forms.email'),
            'idCard' => 'required|string|unique:User,idCard,'.$idToIgnore.'|max:'.config('forms.idCard'),
            'phone' => 'required|string|max:'.config('forms.phone'),
            
            'socialName' => 'required|string|max:'.config('forms.socialName'),
            'description' => 'required|string|max:'.config('forms.user_description'),
            'headquartersLocation' => 'required|string|max:'.config('forms.headquartersLocation'),
            'web' => 'required|url|max:'.config('forms.url'),
            'linksWithNearbyEntities' => 'nullable|string|max:'.config('forms.linksWithNearbyEntities'),
        ];

        $this->validate($request, $rules);
    }
    
    private function requestToUser(Request $request, $user) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->idCard = $request->idCard;
        $user->phone = $request->phone;
    }
    
    private function requestToOrganization(Request $request, $organization) {
        $organization->socialName = $request->socialName;
        $organization->description = $request->description;
        $organization->headquartersLocation = $request->headquartersLocation;
        $organization->web = $request->web;
        $organization->linksWithNearbyEntities = $request->linksWithNearbyEntities;
    }
}
