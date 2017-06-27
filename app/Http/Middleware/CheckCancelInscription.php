<?php

namespace App\Http\Middleware;

use Closure;
use App\Inscription;

class CheckCancelInscription
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
