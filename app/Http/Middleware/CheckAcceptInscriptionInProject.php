<?php

namespace App\Http\Middleware;

use Closure;
use App\InscriptionInProject;

class CheckAcceptInscriptionInProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        try{
            $inscriptionInProject = InscriptionInProject::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        
        if (($inscriptionInProject->project->teacher->id == $user->id) && 
                ($inscriptionInProject->project->state == 1)){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
