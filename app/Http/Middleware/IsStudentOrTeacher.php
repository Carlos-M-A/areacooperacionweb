<?php

namespace App\Http\Middleware;

use Closure;

class IsStudentOrTeacher
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
        
        if ($user->role == 1 || $user->role == 2){
            return $next($request);
            
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
