<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller {

    public function search(Request $request) {
        $this->validate($request, [
            'role' => 'required|integer|min:0|max:6',
            'name' => 'nullable|string|max:' . config('forms.user_name'),
            'idCard' => 'nullable|string|max:' . config('forms.idCard'),
        ]);

        $users = User::where('accepted', true);

        if ($request->role != 0) {
            $users->where('role', $request->role);
        }
        if (!is_null($request->name)) {
            $users->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if (!is_null($request->idCard)) {
            $users->where('idCard', 'LIKE', '%' . $request->idCard . '%');
        }

        return view('users/users')->with('users', $users->get());
    }

    public function registrationRequests() {
        $users = User::where('accepted', false);
        return view('users/registrationRequests')->with('users', $users->get());
    }

}
