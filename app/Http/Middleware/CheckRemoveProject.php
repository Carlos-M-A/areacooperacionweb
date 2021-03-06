<?php

namespace App\Http\Middleware;

use Closure;
use App\Project;

class CheckRemoveProject
{
    /**
     * Check if the user who make the request can remove the project
     * The project must be in proposed state
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
        
        
        if (( (! $project->createdByAdmin) && ($project->teacher->id == $user->id) &&  $project->state == 1)
                || ($user->role == 5 && $project->state == 3)){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
