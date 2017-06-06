<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Organization;

class OrganizationController extends Controller {
    
    public function organization($id) {
        $organization = Organization::find($id);
        return view('users/organization')->with('organization', $organization);
    }
    
    public function index() {
        return view('users/registerOrganization');
    }

    //
    public function registerOrganization(Request $request) {


        $rules = [
            'name' => 'required|string|max:'.config('forms.user_name'),
            'email' => 'required|string|email|unique:User|max:'.config('forms.email'),
            'idCard' => 'required|string|unique:User|max:'.config('forms.idCard'),
            'phone' => 'required|string|max:'.config('forms.phone'),
        ];

        $rules['socialName'] = 'required|string|max:'.config('forms.socialName');
        $rules['description'] = 'required|string|max:'.config('forms.user_description');
        $rules['headquartersLocation'] = 'required|string|max:'.config('forms.headquartersLocation');
        $rules['web'] = 'required|url|max:'.config('forms.url');
        $rules['linksWithNearbyEntities'] = 'nullable|string|max:'.config('forms.linksWithNearbyEntities');

        $this->validate($request, $rules);

        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->idCard = $request->idCard;
        $user->phone = $request->phone;
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
        $organization->socialName = $request->socialName;
        $organization->description = $request->description;
        $organization->headquartersLocation = $request->headquartersLocation;
        $organization->web = $request->web;
        $organization->linksWithNearbyEntities = $request->linksWithNearbyEntities;
        $organization->save();

        return redirect('users/'.$user->id);
    }

}
