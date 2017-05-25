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
            'wantsToBeContacted' => 'required|boolean',
        ];
        $this->validate($request, $rules);
        
        $tutelageProposal = new TutelageProposal();
        $tutelageProposal->comment = $request->comment;
        $tutelageProposal->wantsToBeContacted = $request->wantsToBeContacted;
        $tutelageProposal->teacher_id = $user->id;
        $tutelageProposal->project_id = $project->id;
        $tutelageProposal->state = 1; //Not evaluated
        $tutelageProposal->creationDate = new \DateTime();
        $tutelageProposal->save();
        
        
        return redirect('/projects/'.$project->id);
    }
    
    public function remove($id) {
        $tutelageProposal = TutelageProposal::find($id);
        $tutelageProposal->delete();
        return redirect('/projects/'.$tutelageProposal->project_id);
    }
    
    public function accept($id) {
        $tutelageProposalAccepted = TutelageProposal::find($id);
        $project = $tutelageProposalAccepted->project;
        $tutelageProposals = $project->tutelageProposals;
        
        foreach ($tutelageProposals as $tutelageProposal) {
             $tutelageProposal->state = 3; //Not choosen
             $tutelageProposal->save();
        }
        $tutelageProposalAccepted->state = 2; //Choosen
        $tutelageProposalAccepted->save();
        
        $project->tutor = $tutelageProposal->teacher->user->getNameAndSurnames();
        $project->state = 2; //state = started
        $project->save();
        
        return redirect('/projects/'.$tutelageProposal->project_id);
    }
    
    
}
