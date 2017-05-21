<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Organization;

class OrganizationsController extends Controller {

    public function index() {
        return view('users/registerOrganization');
    }

    //
    public function registerOrganization(Request $request) {


        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:190|unique:User',
            'idCard' => 'required|string|max:20|unique:User',
            'phone' => 'required|string|max:30',
        ];

        $rules['socialName'] = 'required|string|max:200';
        $rules['description'] = 'required|string|max:500';
        $rules['urlLogoImage'] = 'nullable|string';
        $rules['headquartersLocation'] = 'required|string|max:500';
        $rules['web'] = 'required|url|max:200';
        $rules['linksWithNearbyEntities'] = 'nullable|string|max:500';

        $this->validate($request, $rules);

        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->idCard = $request->idCard;
        $user->phone = $request->phone;
        //creamos un password al azar
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
        $organization->urlLogoImage = $request->urlLogoImage;
        $organization->headquartersLocation = $request->headquartersLocation;
        $organization->web = $request->web;
        $organization->linksWithNearbyEntities = $request->linksWithNearbyEntities;
        $organization->save();

        return redirect('users/'.$user->id);
    }

}
