<?php

namespace App\Http\Middleware;

use Closure;
use App\Offer;

class CheckEditOffer
{
    /**
     * Checks if the user who make the request can edit a offer
     * The offer must be open.
     * THe user who make the request can be the same who made the offer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        try{
            $offer = Offer::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        
        if (((($offer->organization->id == $user->id) && !$offer->managedByArea) || ($offer->managedByArea && $user->role == 5))
                && $offer->open){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
