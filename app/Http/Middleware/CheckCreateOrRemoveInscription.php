<?php

namespace App\Http\Middleware;

use Closure;
use App\Convocatory;

class CheckCreateOrRemoveInscription
{
    /**
     * Checks if the user who make the request can create a new inscription in the convocatory
     * or remove his inscription if he has one
     * The convocatory must be open
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $convocatory = Convocatory::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        
        if ($convocatory->state == 1){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
