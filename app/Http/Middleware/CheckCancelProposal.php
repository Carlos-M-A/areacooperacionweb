<?php

namespace App\Http\Middleware;

use Closure;
use App\Proposal;

class CheckCancelProposal
{
    /**
     * Checks if the user who make the request can mark the proposal as cancelled.
     * The offer of the proposal must be in open 
     *  and the user who made the proposal must be the same who make the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        try{
            $proposal = Proposal::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        
        if ($proposal->student->id == $user->id && 
                $proposal->state < 4){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
