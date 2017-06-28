<?php

namespace App\Http\Middleware;

use Closure;
use App\Offer;

class CheckCreateProposal
{
    /**
     * Checks if the user who make the request can create a new proposal in the offer
     * The offer must be open. If the offer depends on a convocatory, the user who
     * make the request must be accepted in this convocatory.
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
            
        
        if ($offer->open && 
                ((! $offer->isOfferOfConvocatory) || 
                        ($offer->isOfferOfConvocatory && $user->student->isAcceptedInConvocatory($offer->offerOfConvocatory->convocatory)))){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
