<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRemoved
{
    /**
     * Check if the user who make the request is removed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->removed){
            return abort(403, 'Unauthorized action');
        }
        
        return $next($request);
    }
}
