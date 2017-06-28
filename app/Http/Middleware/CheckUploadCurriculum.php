<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckUploadCurriculum
{
    /**
     * Check if the user who make the request can upload a new curriculum
     * The user whose curriculum will be updated must be the same that make the request
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
        
        if ($user->id == $userOfFile->id){
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
