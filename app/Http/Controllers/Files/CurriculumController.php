<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Student;

class CurriculumController extends Controller {

    //Route to redirect after a action in profile
    protected $redirectTo = 'profile';

    public function showUpload() {
        return view('profile/uploadCurriculum');
    }

    public function get($file) {
        $curriculum = Storage::get('curriculums/' . $file);

        return response()->make($curriculum, 200, ['content-type' => 'application/pdf']);
    }

    public function upload(Request $request) {
        $user = Auth::user();

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
