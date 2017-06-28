<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckUploadAvatar
{
    /**
     * Check if the user who make the request can remove the inscription
     * The inscription must be in not chosen state
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        try{
            $userOfFile = User::findOrFail($request->route('idUser'));
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        if (($user->role == 6) || ($user->id == $userOfFile->id)){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action');
        }
    }
}
