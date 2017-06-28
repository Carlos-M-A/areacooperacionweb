<?php

namespace App\Http\Middleware;

use Closure;

class IsPerson
{
    /**
     * Check if the user who make the request is a person (teacher, student or other)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        
        if ($user->role <= 3){
            return $next($request);
            
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
