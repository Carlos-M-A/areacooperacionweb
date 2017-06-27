<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        
        
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            //\Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        
        'checkAccepted' => \App\Http\Middleware\CheckAccepted::class,
        
        'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        'isCooperationArea' => \App\Http\Middleware\IsCooperationArea::class,
        'isCooperationAreaOrAdmin' => \App\Http\Middleware\IsCooperationAreaOrAdmin::class,
        'isCooperationAreaOrTeacher' => \App\Http\Middleware\IsCooperationAreaOrTeacher::class,
        'isOrganization' => \App\Http\Middleware\IsOrganization::class,
        'isPerson' => \App\Http\Middleware\IsPerson::class,
        'isStudent' => \App\Http\Middleware\IsStudent::class,
        'isTeacher' => \App\Http\Middleware\IsTeacher::class,
        'isStudentOrTeacher' => \App\Http\Middleware\IsStudentOrTeacher::class,
        
        'checkAcceptInscriptionInProject' => \App\Http\Middleware\CheckAcceptInscriptionInProject::class,
        'checkAcceptProposal' => \App\Http\Middleware\CheckAcceptProposal::class,
        'checkApproveOrRejectProposal' => \App\Http\Middleware\CheckApproveOrRejectProposal::class,
        'checkCancelInscription' => \App\Http\Middleware\CheckCancelInscription::class,
        'checkCancelInscriptionInProject' => \App\Http\Middleware\CheckCancelInscriptionInProject::class,
        'checkCancelProposal' => \App\Http\Middleware\CheckCancelProposal::class,
        'checkCloseConvocatory' => \App\Http\Middleware\CheckCloseConvocatory::class,
        'checkCreateInscriptionInProject' => \App\Http\Middleware\CheckCreateInscriptionInProject::class,
        'checkCreateOrRemoveInscription' => \App\Http\Middleware\CheckCreateOrRemoveInscription::class,
        'checkCreateProposal' => \App\Http\Middleware\CheckCreateProposal::class,
        'checkEditConvocatory' => \App\Http\Middleware\CheckEditConvocatory::class,
        'checkEditInscription' => \App\Http\Middleware\CheckEditInscription::class,
        'checkEditOffer' => \App\Http\Middleware\CheckEditOffer::class,
        'checkEditProject' => \App\Http\Middleware\CheckEditProject::class,
        'checkGetOffer' => \App\Http\Middleware\CheckGetOffer::class,
        'checkGetUser' => \App\Http\Middleware\CheckGetUser::class,
        'checkRemoveInscriptionInProject' => \App\Http\Middleware\CheckRemoveInscriptionInProject::class,
        'checkRemoveProject' => \App\Http\Middleware\CheckRemoveProject::class,
        'checkRemoveProposal' => \App\Http\Middleware\CheckRemoveProposal::class,
        'checkRemoveUser' => \App\Http\Middleware\CheckRemoveUser::class,
        'checkRemoved' => \App\Http\Middleware\CheckRemoved::class,
        'checkUploadAvatar' => \App\Http\Middleware\CheckUploadAvatar::class,
        'checkUploadCurriculum' => \App\Http\Middleware\CheckUploadCurriculum::class,
        
    ];
}
