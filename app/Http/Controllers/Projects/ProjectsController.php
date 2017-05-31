<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\InscriptionInProject;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function showCreateProject() {
        return view('projects/createProject');
    }
    
    public function createProject(Request $request){
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'scope' => 'required|string|max:100',
            'description' => 'required|string|max:100',
            'studyId' => 'required|int|min:1',
        ]);
        $user = Auth::user(); //The teacher
        
        $project = new Project();
        $project->study_id = $request->studyId;
        $project->title = $request->title;
        $project->scope = $request->scope;
        $project->description = $request->description;
        $project->teacher_id = $user->id;
        $project->tutor = $user->getNameAndSurnames();
        $project->createdDate = new \DateTime();
        $project->state = 1; //state = Project proposal
        $project->save();
        
        return redirect('projects/'.$project->id);
    }
    
    public function myProjects() {
        $user = Auth::user();
        switch ($user->role){
            case 1:
                $projects = Project::whereHas('inscriptionsInProject', function ($query) {
                    $user = Auth::user();
                    $query->where('student_id', $user->id);
                    $query->where('state', 2);
                });
                break;
            case 2:
                $projects = Project::where('teacher_id', $user->id);
                break;
        }
        
        return view('projects/projects')->with('projects', $projects->get());
    }
            
    public function openProjects() {
        $projects = Project::where('state', 1);
        
        return view('projects/projects')->with('projects', $projects->get());
    }
    
    public function project($id) {
        $project = Project::find($id);
        $user = Auth::user();
        
        switch($user->role){
            case 1:
                $inscriptionInProject = InscriptionInProject::where('project_id', $project->id)->where('student_id', $user->id)->get()->first();
                if(is_null($inscriptionInProject)){
                    return view('projects/projectAsStudent')->with('project', $project)->with('inscriptionInProject');
                } else {
                    return view('projects/projectAsStudent')->with('project', $project)->with('inscriptionInProject', $inscriptionInProject);
                }
            case 2:
                $inscriptionInProjectChoosen = InscriptionInProject::where('project_id', $project->id)->where('state', 2)->get()->first();
                if(is_null($inscriptionInProjectChoosen)){
                    return view('projects/projectAsTeacher')->with('project', $project)->with('inscriptionInProjectChoosen');
                } else {
                    return view('projects/projectAsTeacher')->with('project', $project)->with('inscriptionInProjectChoosen', $inscriptionInProjectChoosen);
                }
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
    
    
    
    public function finish($id, Request $request) {
        $rules = [
            'urlDocumentation' => 'required|string|max:200',
        ];
        $this->validate($request, $rules);
        
        $project = Project::find($id);
        $project->state = 3;
        $project->urlDocumentation = $request->urlDocumentation;
        $project->save();
        
        return redirect('projects/'.$project->id);
    }
}
