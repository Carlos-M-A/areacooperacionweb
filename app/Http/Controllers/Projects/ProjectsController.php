<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

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
        
        return view('projects/project')->with('project', $project);
}
}
