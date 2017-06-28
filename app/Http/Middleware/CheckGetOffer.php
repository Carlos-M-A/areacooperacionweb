<?php

namespace App\Http\Middleware;

use Closure;
use App\Offer;

class CheckGetOffer
{
    /**
     * Checks if the user who make the request can get a offer data
     * A studente and the Area of cooperation always can
     * A organizations only can if he is the organization of the offer 
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
        
        switch ($user->role){
            case 1:
                return $next($request);
                break;
            case 4:
                if ($offer->organization->id == $user->id){
                    return $next($request);
                } else {
                    return abort(403, 'Unauthorized action.');
                }
                break;
            case 5:
                return $next($request);
                break;
            default:
                return abort(403, 'Unauthorized action.');
        }
        
    }
}
