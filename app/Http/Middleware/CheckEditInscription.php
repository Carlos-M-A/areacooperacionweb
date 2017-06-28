<?php

namespace App\Http\Middleware;

use Closure;
use App\Inscription;

class CheckEditInscription
{
    /**
     * Checks if the user who make the request can edit (evaluate) a inscription in convocatory
     * The convocatory must be in out of time state
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $inscription = Inscription::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        
        if ($inscription->convocatory->state == 2){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
