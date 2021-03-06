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

    public function showUpload(int $idUser) {
        $user = User::find($idUser);
        return view('files/uploadCurriculum')->with('user', $user);
    }

    public function get($file) {
        $curriculum = Storage::get('curriculums/' . $file);

        return response()->make($curriculum, 200, ['content-type' => 'application/pdf']);
    }

    /**
     * Removes the old curriculum pdf of the student and save the new one
     * @param int $idUser
     * @param Request $request
     * @return type
     */
    public function upload(int $idUser, Request $request) {
        $user = User::find($idUser);

        $rules['urlCurriculum'] = 'required|file|mimes:pdf|max:'. config('constants.max_size_of_curriculums');
        $this->validate($request, $rules);

        $student = Student::find($user->id);
        if ($request->hasFile('urlCurriculum')) {
            Storage::delete($student->urlCurriculum);
            $student->urlCurriculum = $request->urlCurriculum->store('curriculums');
        }
        $student->save();
        return redirect($this->redirectTo);
    }

}
