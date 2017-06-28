<?php

namespace App\Http\Middleware;

use Closure;
use App\Convocatory;

class CheckEditConvocatory
{
    /**
     * Checks if the user who make the request can edit a convocatory
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
