<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\TutelageProposal;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function createProject(Request $request){
        $user = Auth::user(); //The teacher
            
        $project = new Project();
        $project->study_id = $request->study_id;
        $project->title = $request->title;
        $project->scope = $request->scope;
        $project->description = $request->description;
        $project->teacher_id = $user->id;
        $project->createdDate = new \DateTime();
        $project->state = 1; //state = Project proposal
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
    
    /**
     * Return the projects in 'Without tutor' state, in which the teacher has
     * not made a tutelage proposal and in which the study of project is teached
     * by the teacher who call the function
     * @return The projects
     */
    public function newProjectsWithoutTutor() {
        $projects = Project::whereDoesntHave('tutelageProposals', function ($query) {
            $user = Auth::user();
            $query->where('teacher_id', $user->id);
        });
        $projects->where('state', 1);
        
        return view('projects/projects')->with('projects', $projects->get());
    }
    
    public function myTutoredProjects() {
        $projects = Project::whereHas('tutelageProposals', function ($query) {
            $user = Auth::user();
            $query->where('teacher_id', $user->id);
            $query->where('state', 2);
        });
        
        return view('projects/projects')->with('projects', $projects->get());
    }
    
    public function projectsWithTutelageProposal() {
        $projects = Project::whereHas('tutelageProposals', function ($query) {
            $user = Auth::user();
            $query->where('teacher_id', $user->id);
        });
        
        return view('projects/projects')->with('projects', $projects->get());
    }
    
    
    public function project($id) {
        $project = Project::find($id);
        $user = Auth::user();
        
        switch($user->role){
            case 1:
                $tutelageProposalChoosen = TutelageProposal::where('project_id', $project->id)->where('state', 2)->get()->first();
                if(is_null($tutelageProposalChoosen)){
                    return view('projects/projectAsStudent')->with('project', $project)->with('tutelageProposalChoosen');
                } else {
                    return view('projects/projectAsStudent')->with('project', $project)->with('tutelageProposalChoosen', $tutelageProposalChoosen);
                }
            case 2:
                $tutelageProposal = TutelageProposal::where('project_id', $project->id)->where('teacher_id', $user->id)->get()->first();
                if(is_null($tutelageProposal)){
                    return view('projects/projectAsTeacher')->with('project', $project)->with('tutelageProposal');
                } else {
                    return view('projects/projectAsTeacher')->with('project', $project)->with('tutelageProposal', $tutelageProposal);
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
    
    public function enterTutorManually($id, Request $request) {
        $rules = [
            'name' => 'required|string|max:100',
            'surnames' => 'required|string|max:100',
        ];
        $this->validate($request, $rules);
        
        $project = Project::find($id);
        $tutelageProposals = $project->tutelageProposals;
        
        foreach ($tutelageProposals as $tutelageProposal) {
             $tutelageProposal->state = 3; //Not choosen
             $tutelageProposal->save();
        }
        
        $project->tutor = $request->name.', '.$request->surnames;
        $project->state = 2; //state = started
        $project->save();
        
        return redirect('/projects/'.$tutelageProposal->project_id);
    }
    
    public function terminate($id, Request $request) {
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
