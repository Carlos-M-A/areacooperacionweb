<?php

namespace App\Http\Middleware;

use Closure;

class IsCooperationAreaOrTeacher
{
    /**
     * Check if the user who make the request is the cooperation area or a teacher
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        
        if ($user->role == 2 || $user->role == 5){
            return $next($request);
            
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
