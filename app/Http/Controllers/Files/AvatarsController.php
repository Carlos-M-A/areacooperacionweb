<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;

class AvatarsController extends Controller
{
    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';
    
    public function get($file)
    {
        $image = Storage::get('avatars/' . $file );

        return response()->make($image, 200, ['content-type' => 'image']);
    }
    
    public function upload(Request $request) {
        $user = Auth::user();
        
        $rules = [
            'urlAvatar' => 'required|image|dimensions:max_width=256,max_height=256,ratio=1',
        ];
        $this->validate($request, $rules);
        
        if($request->hasFile('urlAvatar')){
            $user->urlAvatar = $request->urlAvatar->store('avatars');
        }
        $user->save();
        return redirect($this->redirectTo);
    }
    
    public function showUploadAvatar() {
        return view('profile/uploadAvatar');
    }
}
