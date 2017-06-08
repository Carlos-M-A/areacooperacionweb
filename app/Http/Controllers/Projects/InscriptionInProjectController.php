<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\InscriptionInProject;
use Illuminate\Support\Facades\Auth;

class InscriptionInProjectController extends Controller {

    public function create($id, Request $request) {
        $project = Project::find($id);
        $user = Auth::user();

        $rules = [
            'comment' => 'required|string|max:' . config('forms.comment'),
        ];
        $this->validate($request, $rules);

        $inscriptionInProject = new InscriptionInProject();
        $inscriptionInProject->comment = $request->comment;
        $inscriptionInProject->student_id = $user->id;
        $inscriptionInProject->project_id = $project->id;
        $inscriptionInProject->state = 1; //Not evaluated
        $inscriptionInProject->createdDate = new \DateTime();
        $inscriptionInProject->save();

        return redirect('/projects/' . $project->id);
    }

    public function remove($id) {
        $inscriptionInProject = InscriptionInProject::find($id);
        $project = $inscriptionInProject->project;
        $project->state = 1;
        $project->save();
        $inscriptionInProject->delete();
        return redirect('/projects/' . $inscriptionInProject->project_id);
    }

    public function cancel($id) {
        $inscriptionInProject = InscriptionInProject::find($id);
        $user = Auth::user();
        if ($user->role == 1) { //Caller is a student
            $inscriptionInProject->state = 3;
        } elseif ($user->role == 2) { // caller is a teacher
            $inscriptionInProject->state = 1;
        }
        $inscriptionInProject->save();

        $project = $inscriptionInProject->project;
        $project->state = 1;
        $project->save();

        return redirect('/projects/' . $inscriptionInProject->project_id);
    }

    public function accept($id) {
        $inscriptionInProjectAccepted = InscriptionInProject::find($id);
        $project = $inscriptionInProjectAccepted->project;
        $inscriptionInProjectAccepted->state = 2; //Choosen
        $inscriptionInProjectAccepted->save();

        $project->author = $inscriptionInProjectAccepted->student->user->getNameAndSurnames();
        $project->state = 2; //state = started
        $project->save();

        return redirect('/projects/' . $project->id);
    }

}
