<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;

class AvatarController extends Controller {

    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';

    public function showUpload(int $idUser) {
        $user = User::find($idUser);
        return view('files/uploadAvatar')->with('user', $user);
    }

    public function get($file) {
        $image = Storage::get('avatars/' . $file);

        return response()->make($image, 200, ['content-type' => 'image']);
    }

    public function upload(int $idUser, Request $request) {
        $user = User::find($idUser);

        $rules = [
            'urlAvatar' => 'required|image|dimensions:max_width='. config('constants.max_width_height_images').',max_height='. config('constants.max_width_height_images').'|max:'. config('constants.max_size_of_images'),
        ];
        $this->validate($request, $rules);
        
        if ($request->hasFile('urlAvatar')) {
            Storage::delete($user->urlAvatar);
            $user->urlAvatar = $request->urlAvatar->store('avatars');
        }
        $user->save();
        
        if(Auth::user()->role == 6 && Auth::user()->id != $idUser){
            return redirect('users/'. $user->id);
        }
        return redirect($this->redirectTo);
    }

}
