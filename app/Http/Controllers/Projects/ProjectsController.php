<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller {
    
    public function index() {
        switch (Auth::user()->role){
            case 1:
            case 2:
                return $this->myProjects();
            case 5:
                return $this->finishedProjects();
            default:
                return $this->finishedProjects();
        }
    }

    public function myProjects() {
        $user = Auth::user();
        switch ($user->role) {
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

        return view('projects/projects')->with('projects', $projects->latest('createdDate')->paginate(config('constants.pagination')))->with('ask', 1);
    }

    public function proposedProjects() {
        $user = Auth::user();
        $projects = Project::where('state', 1)->where('study_id', $user->student->study_id);

        return view('projects/projects')->with('projects', $projects->latest('createdDate')->paginate(config('constants.pagination')))->with('ask', 2);;
    }

    public function finishedProjects() {
        $projects = Project::where('state', 3);

        return view('projects/projects')->with('projects', $projects->latest('finishedDate')->paginate(config('constants.pagination')));
    }
}
