<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckUploadCurriculum
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
