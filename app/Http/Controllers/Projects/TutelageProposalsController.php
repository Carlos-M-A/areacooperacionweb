<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\TutelageProposal;
use Illuminate\Support\Facades\Auth;


class TutelageProposalsController extends Controller
{
    public function create($id, Request $request) {
        $project = Project::find($id);
        $user = Auth::user();
        
        $rules = [
            'comment' => 'required|string|max:100',
        ];
        $this->validate($request, $rules);
        
        $tutelageProposal = new TutelageProposal();
        $tutelageProposal->comment = $request->comment;
        $tutelageProposal->student_id = $user->id;
        $tutelageProposal->project_id = $project->id;
        $tutelageProposal->state = 1; //Not evaluated
        $tutelageProposal->createdDate = new \DateTime();
        $tutelageProposal->save();
        
        
        return redirect('/projects/'.$project->id);
    }
    
    public function remove($id) {
        $tutelageProposal = TutelageProposal::find($id);
        $project = $tutelageProposal->project;
        $project->state = 1;
        $project->save();
        $tutelageProposal->delete();
        return redirect('/projects/'.$tutelageProposal->project_id);
    }
    
    public function cancel($id) {
        $tutelageProposal = TutelageProposal::find($id);
        $user = Auth::user();
        if($user->role == 1){ //Caller is a student
            $tutelageProposal->state = 3;
        } elseif($user->role == 2){ // caller is a teacher
            $tutelageProposal->state = 1;
        }
        $tutelageProposal->save();
        
        $project = $tutelageProposal->project;
        $project->state = 1;
        $project->save();
        
        return redirect('/projects/'.$tutelageProposal->project_id);
    }
    
    public function accept($id) {
        $tutelageProposalAccepted = TutelageProposal::find($id);
        $project = $tutelageProposalAccepted->project;
        $tutelageProposalAccepted->state = 2; //Choosen
        $tutelageProposalAccepted->save();
        
        $project->author = $tutelageProposalAccepted->student->user->getNameAndSurnames();
        $project->state = 2; //state = started
        $project->save();
        
        return redirect('/projects/'.$project->id);
    }
    
    
}
