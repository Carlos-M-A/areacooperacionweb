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
        $inscriptionInProject->delete();
        return redirect('/projects/' . $inscriptionInProject->project_id);
    }

    public function cancel($id) {
        $inscription = InscriptionInProject::find($id);
        $project = $inscription->project;
        
            $inscription->delete();
            $project->author = '';
            $project->state = 1;
            $project->save();
            
            $inscriptions = InscriptionInProject::where('student_id', $inscription->student->id)->where('state', 3)->get();
            
            foreach($inscriptions as $inscription2){
                    $inscription2->state = 1;
                    $inscription2->save();
            }
        
        
        return redirect('/projects/' . $inscription->project_id);
    }

    public function accept($id) {
        $inscription = InscriptionInProject::find($id);
        $project = $inscription->project;
        
        $inscription->state = 2; //Chosen
        $inscription->save();

        $project->author = $inscription->student->user->getNameAndSurnames();
        $project->state = 2; //state = started
        $project->save();
        
        $inscriptions = InscriptionInProject::where('student_id', $inscription->student->id)->where('state', 1)->get();
            foreach($inscriptions as $inscription2){
                    $inscription2->state = 3;
                    $inscription2->save();
            }                
        
        return redirect('/projects/' . $project->id);
    }

}
