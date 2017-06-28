<?php

namespace App\Http\Middleware;

use Closure;

class IsCooperationAreaOrAdmin
{
    /**
     * Check if the user who make the request is the cooperation area or the admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        
        if ($user->role >= 5){
            return $next($request);
            
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
