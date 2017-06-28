<?php

namespace App\Http\Middleware;

use Closure;
use App\Inscription;

class CheckCancelInscription
{
    /**
     * Checks if the user who make the request can mark the inscription as cancelled.
     * The convocatory of the inscription must be in out of time state
     *  and the user who made the inscription must be the same who make the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        
        try{
            $inscription = Inscription::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        
        if ($inscription->student->id == $user->id && $inscription->convocatory->state == 2){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
