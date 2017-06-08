<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\RoleChangeRequest;

class RoleChangesController extends Controller {

    /**
     * Show the main screen of the role change requests
     * @return type
     */
    public function all() {
        $requests = RoleChangeRequest::all();
        return view('users/roleChanges')->with('requests', $requests);
    }

}
