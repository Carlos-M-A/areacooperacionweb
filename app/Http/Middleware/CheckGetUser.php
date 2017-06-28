<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\InscriptionInProject;
use App\Proposal;
use App\Project;

class CheckGetUser
{
    private $user;
    private $userRequested;
    /**
     * Checks if the user who make the request can get a user data
     * the admin and the Area of cooperation always can
     * A student can access to the organizations and the teachers who have a project in his stuty
     * A Teacher can access ti the students that have inscriptions in any project his
     * A Teacher can access ti the students that have proposals in any offer his
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $this->user = $user;
        
        try{
            $userRequested = User::findOrFail($request->route('id'));
            $this->userRequested = $userRequested;
        } catch (Exception $e){
            return abort(404, 'Resource Not Found.');
        }
        
        if(($userRequested->role > 3)){
             return $next($request);
        }
        switch ($user->role){
            case 1:
                if($userRequested->role == 2){
                    $amountOfInscriptionsHisProjects = InscriptionInProject::whereHas('project', function ($query) {
                        $query->where('teacher_id', $this->userRequested->id);
                    })->where('student_id', $user->id)->count();
                    
                    $amountOfProjectsInMyStudy = Project::where('teacher_id', $userRequested->id)->where('study_id', $user->student->study->id)
                            ->where('state', 1)->count();
                    
                    if(($amountOfInscriptionsHisProjects > 0) || ($amountOfProjectsInMyStudy > 0)){
                        return $next($request);
                    }
                }
                break;
            case 2:
                if($userRequested->role == 1){
                    $amountOfInscriptionsInMyProjects = InscriptionInProject::whereHas('project', function ($query) {
                        $query->where('teacher_id', $this->user->id);
                    })->where('student_id', $userRequested->id)->count();
                    if($amountOfInscriptionsInMyProjects > 0){
                        return $next($request);
                    }
                }
                break;
            case 3:
                break;
            case 4:
                $amountOfProposalsInMyOffers = Proposal::whereHas('offer', function ($query) {
                    $query->where('organization_id', $this->user->id);
                })->where('student_id', $userRequested->id)->count();
                
                if($amountOfProposalsInMyOffers > 0){
                    return $next($request);
                }
                break;
            
            
            case 5:
                return $next($request);
                break;
            case 6;
                return $next($request);
                break;
            default:
                return abort(403, 'Unauthorized action.');
        }
        return abort(403, 'Unauthorized action.');
    }
}
