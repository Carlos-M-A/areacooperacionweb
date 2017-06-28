<?php

namespace App\Http\Middleware;

use Closure;
use App\InscriptionInProject;
class CheckCancelInscriptionInProject
{
    /**
     * Checks if the user who make the request can mark the inscription as cancelled.
     * The project of the inscription must be started
     *  and the user who made the project of the inscription must be the same who make the request
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
        
        switch ($user->role){
            case 1:
                if (($inscriptionInProject->student->id == $user->id)  && 
                        ($inscriptionInProject->state == 2)){
                    return $next($request);
                } else {
                    return abort(403, 'Unauthorized action.');
                }
                break;
            case 2:
                if (($inscriptionInProject->project->teacher->id == $user->id)  && 
                        ($inscriptionInProject->state == 2)){
                    return $next($request);
                } else {
                    return abort(403, 'Unauthorized action.');
                }
                break;
        }
        
    }
}
