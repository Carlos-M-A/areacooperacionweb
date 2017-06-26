<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\InscriptionInProject;
use Illuminate\Support\Facades\Auth;
use DateTime;

class ProjectController extends Controller {

    public function showCreate() {
        $user = Auth::user();

        switch ($user->role) {
            case 2:
                return view('projects/createProject');
            case 5:
                return view('projects/createProjectAsCooperationArea');
        }
    }

    public function showEdit($id) {
        $project = Project::find($id);
        $user = Auth::user();

        switch ($user->role) {
            case 2:
                return view('projects/editProject')->with('project', $project);
            case 5:
                return view('projects/editProjectAsCooperationArea')->with('project', $project);
        }
        return view('projects/editProject')->with('project', $project);
    }

    public function get($id, Request $request) {
        $project = Project::find($id);
        if(! Auth::check()){
            return view('projects/project')->with('project', $project);
        }
        $user = Auth::user();

        switch ($user->role) {
            case 1:
                $inscriptionInProject = InscriptionInProject::where('project_id', $project->id)->where('student_id', $user->id)->get()->first();
                if (is_null($inscriptionInProject)) {
                    return view('projects/projectAsStudent')->with('project', $project)->with('inscriptionInProject');
                } else {
                    return view('projects/projectAsStudent')->with('project', $project)->with('inscriptionInProject', $inscriptionInProject);
                }
            case 2:
                $this->validate($request, [
                    'stateOfInscriptions' => 'nullable|integer|min:1|max:3',
                ]);
                $state = 1;
                if(!is_null($request->stateOfInscriptions)){
                    $state = $request->stateOfInscriptions;
                }
                $request->flash();
                
                $inscriptions = InscriptionInProject::where('project_id', $project->id)->where('state', $state)->paginate(config('constants.pagination'));
                $inscriptionInProjectChosen = InscriptionInProject::where('project_id', $project->id)->where('state', 2)->get()->first();
                if (is_null($inscriptionInProjectChosen)) {
                    return view('projects/projectAsTeacher')->with('project', $project)->with('inscriptions', $inscriptions)->with('inscriptionInProjectChosen');
                } else {
                    return view('projects/projectAsTeacher')->with('project', $project)->with('inscriptions', $inscriptions)->with('inscriptionInProjectChosen', $inscriptionInProjectChosen);
                }
            case 5:
                return view('projects/projectAsCooperationArea')->with('project', $project);
        }
        return view('projects/project')->with('project', $project);
    }

    public function create(Request $request) {
        $user = Auth::user();
        
        $rules = $this->_getProjectFieldsRules();
        $rules['studyId'] = 'required|int|min:1';
        if($user->role == 5){
            $rules['finishedDate'] = 'required|date|before:tomorrow';
            $rules['tutor'] = 'required|string|max:' . config('forms.tutor');
            $rules['author'] = 'required|string|max:' . config('forms.author');
            $rules['urlDocumentation'] = 'required|url|max:' . config('forms.url');
        }
        $this->validate($request, $rules);

        $project = new Project();
        $this->_requestToProject($request, $project);
        $project->study_id = $request->studyId;
        $project->createdDate = new DateTime();
        
        if($user->role == 5){
            $project->teacher_id = $user->id;
            $project->tutor = $request->tutor;
            $project->author = $request->author;
            $project->state = 3; //state = Finished
            $project->urlDocumentation = $request->urlDocumentation;
            $project->finishedDate = $request->finishedDate;
            $project->createdByAdmin = true;
        } else {
            $project->teacher_id = $user->id;
            $project->tutor = $user->getNameAndSurnames();
            $project->state = 1; //state = Proposed
            $project->createdByAdmin = false;
        }
        $project->save();

        return redirect('projects/' . $project->id);
    }

    public function edit($id, Request $request) {
        $user = Auth::user();
        $project = Project::find($id);
        
        $rules = $this->_getProjectFieldsRules();
        if($user->role == 5){ // role = Cooperation area
            $rules['finishedDate'] = 'required|date|before:tomorrow';
            $rules['urlDocumentation'] = 'required|url|max:' . config('forms.url');
            if($project->createdByAdmin == true){
                $rules['studyId'] = 'required|int|min:1';
                $rules['tutor'] = 'required|string|max:' . config('forms.tutor');
                $rules['author'] = 'required|string|max:' . config('forms.author');
            }
        } else {
            $rules['urlDocumentation'] = 'nullable|url|max:' . config('forms.url');
        }
        $this->validate($request, $rules);
        
        $this->_requestToProject($request, $project);
        $project->urlDocumentation = $request->urlDocumentation;
        if($user->role == 5){
            $project->finishedDate = $request->finishedDate;
            if($project->createdByAdmin == true){
                $project->tutor = $request->tutor;
                $project->author = $request->author;
                $project->study_id = $request->studyId;
            }
        }
        $project->save();

        return redirect('projects/' . $project->id);
    }

    public function finish($id, Request $request) {
        $rules = [
            'urlDocumentation' => 'required|string|max:' . config('forms.url'),
        ];
        $this->validate($request, $rules);

        $project = Project::find($id);
        $project->state = 3;
        $project->urlDocumentation = $request->urlDocumentation;
        $project->finishedDate = new \DateTime();
        $project->save();

        return redirect('projects/' . $project->id);
    }
    
    public function remove(int $id) {
        $project = Project::find($id);
        
        $project->delete();

        return redirect('projects/finishedProjects');
    }

    private function _getProjectFieldsRules() {
        $rules = [
            'title' => 'required|string|max:' . config('forms.project_title'),
            'scope' => 'required|string|max:' . config('forms.scope'),
            'description' => 'required|string|max:' . config('forms.project_description'),
        ];
        return $rules;
    }
    
    private function _requestToProject(Request $request, Project $project) {
        $project->title = $request->title;
        $project->scope = $request->scope;
        $project->description = $request->description;
    }
}
