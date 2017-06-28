<?php

namespace App\Http\Middleware;

use Closure;
use App\InscriptionInProject;

class CheckRemoveInscriptionInProject
{
    /**
     * Check if the user who make the request can remove the inscription
     * The inscription must be in not chosen state
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
        
        
        if (($inscriptionInProject->student->id == $user->id) && 
                ($inscriptionInProject->state == 1)){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
