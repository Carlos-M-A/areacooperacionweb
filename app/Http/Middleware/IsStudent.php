<?php

namespace App\Http\Middleware;

use Closure;

class IsStudent
{
    /**
     * Check if the user who make the request is a student
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        
        if ($user->role == 1){
            return $next($request);
            
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
