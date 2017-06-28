<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckRemoveUser
{
    /**
     * Check if the user who make the request can upload a new avatar
     * The user whose avatar will be updated must be the same that make the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        try{
            $userToRemove = User::findOrFail($request->route('id'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        if (($user->role == 6) || ($user->id == $userToRemove->id)){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action asf');
        }
    }
}
