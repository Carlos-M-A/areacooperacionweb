<?php

namespace App\Http\Middleware;

use Closure;
use App\Project;

class CheckCreateInscriptionInProject
{
    /**
     * Checks if the user who make the request can create a new inscription in the project
     * The project must be in proposed state and the project must be the same study
     * that the user who make the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        try{
            $project = Project::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        
        if (($project->state == 1) && ($project->study->id == $user->student->study->id)){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
