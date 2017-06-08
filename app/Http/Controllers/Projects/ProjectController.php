<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\InscriptionInProject;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller {

    public function showCreate() {
        return view('projects/createProject');
    }

    public function showEdit($id) {
        $project = Project::find($id);
        return view('projects/editProject')->with('project', $project);
    }

    public function get($id) {
        $project = Project::find($id);
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
                $inscriptionInProjectChoosen = InscriptionInProject::where('project_id', $project->id)->where('state', 2)->get()->first();
                if (is_null($inscriptionInProjectChoosen)) {
                    return view('projects/projectAsTeacher')->with('project', $project)->with('inscriptionInProjectChoosen');
                } else {
                    return view('projects/projectAsTeacher')->with('project', $project)->with('inscriptionInProjectChoosen', $inscriptionInProjectChoosen);
                }
        }
        return view('projects/project')->with('project', $project);
    }

    public function create(Request $request) {
        $rules = $this->_getProjectFieldsRules();
        $rules['studyId'] = 'required|int|min:1';
        $this->validate($request, $rules);
        
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

        return redirect('projects/' . $project->id);
    }

    public function edit($id, Request $request) {
        $rules = $this->_getProjectFieldsRules();
        $rules['urlDocumentation'] = 'nullable|string|max:' . config('forms.url');
        $this->validate($request, $rules);
        
        $project = Project::find($id);
        $project->title = $request->title;
        $project->scope = $request->scope;
        $project->description = $request->description;
        $project->urlDocumentation = $request->urlDocumentation;
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
        $project->save();

        return redirect('projects/' . $project->id);
    }

    private function _getProjectFieldsRules() {
        $rules = [
            'title' => 'required|string|max:' . config('forms.project_title'),
            'scope' => 'required|string|max:' . config('forms.scope'),
            'description' => 'required|string|max:' . config('forms.project_description'),
        ];
        return $rules;
    }
}
