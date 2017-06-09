<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Student;
use App\User;

class CurriculumController extends Controller {

    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';

    public function showUpload($idUser) {
        $user = User::find($idUser);
        return view('files/uploadCurriculum')->with('user', $user);
    }

    public function get($file) {
        $curriculum = Storage::get('curriculums/' . $file);

        return response()->make($curriculum, 200, ['content-type' => 'application/pdf']);
    }

    public function upload($idUser, Request $request) {
        $user = User::find($idUser);

        $rules['urlCurriculum'] = 'required|file|mimes:pdf';
        $this->validate($request, $rules);

        $student = Student::find($user->id);
        if ($request->hasFile('urlCurriculum')) {
            $student->urlCurriculum = $request->urlCurriculum->store('curriculums');
        }
        $student->save();
        return redirect($this->redirectTo);
    }

}
