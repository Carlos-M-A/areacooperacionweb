<?php

namespace App\Http\Middleware;

use Closure;
use App\Proposal;

class CheckApproveOrRejectProposal
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
            $proposal = Proposal::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        
        if ((($proposal->offer->organization->id == $user->id) || ($proposal->offer->managedByArea && $user->role == 5)) 
                && $proposal->state < 4 && $proposal->offer->open){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
