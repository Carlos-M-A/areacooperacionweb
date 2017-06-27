<?php

namespace App\Http\Middleware;

use Closure;
use App\Offer;

class CheckCreateProposal
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
