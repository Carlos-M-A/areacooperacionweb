<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAccepted
{
    /**
     * Checks if the user who make the request is accepted
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!$user->accepted){
            return redirect('notAccepted');
        }
        
        return $next($request);
    }
}
