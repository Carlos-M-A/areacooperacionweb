<?php

namespace App\Http\Middleware;

use Closure;
use App\Proposal;

class CheckRemoveProposal
{
    /**
     * Check if the user who make the request can remove the proposal
     * The proposal must be in not evaluated state
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
                $proposal->state == 1){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
