<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller {

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

        return view('projects/projects')->with('projects', $projects->paginate(config('constants.pagination')));
    }

    public function proposedProjects() {
        $projects = Project::where('state', 1);

        return view('projects/projects')->with('projects', $projects->paginate(config('constants.pagination')));
    }

    public function finishedProjects() {
        $projects = Project::where('state', 3);

        return view('projects/projects')->with('projects', $projects->paginate(config('constants.pagination')));
    }
}
