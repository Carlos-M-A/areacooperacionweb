<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function createProject($proposal, $title){
        $project = new Project();
        $project->proposal_id = $proposal->id;
        $project->offer_id = $proposal->offer_id;
        $project->study_id = $proposal->student->study->id;
        $project->title = $title;
        $project->scope = $proposal->offer->scope;
        $project->type = $proposal->type;
        $project->description = '';
        $project->author = $proposal->student->user->getNameAndSurnames();
        $project->organization = $proposal->offer->organization->user->name;
        $project->year = 2015;
        $project->state = 1;
        $project->save();
        
        return redirect('projects/'.$project->id);
    }
    
    public function myProjects() {
        $projects = Project::whereHas('proposal', function ($query) {
            $user = Auth::user();
            $query->where('student_id', $user->id);
        });
        return view('projects/projects')->with('projects', $projects->get());
    }
    
    public function project($id) {
        $project = Project::find($id);
        $user = Auth::user();
        
        switch($user->role){
            case 1:
                return view('projects/projectAsStudent')->with('project', $project);
                break;
        }
        return view('projects/project')->with('project', $project);
    }
    
    public function showEditProject($id) {
        $project = Project::find($id);
        return view('projects/editProject')->with('project', $project);
        
    }
    
    public function editProject($id, Request $request) {
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'scope' => 'required|string|max:100',
            'description' => 'required|string|max:100',
            'urlDocumentation' => 'nullable|string|max:100',
        ]);
        $project = Project::find($id);
        $project->title = $request->title;
        $project->scope = $request->scope;
        $project->description = $request->description;
        $project->urlDocumentation = $request->urlDocumentation;
        $project->save();
        
        return redirect('projects/'.$project->id);
    }
}
