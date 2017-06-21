<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('/auth/login');
})->name('root');

Auth::routes();

Route::get('/notAccepted', function() {
    return view('notAccepted');
});

Route::group(['middleware' => ['auth', 'checkAccepted']], function() {
//Managemer of the homes
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/configuration', 'Configuration\ConfigurationController@index')->name('configuration');
// Profile management
    Route::get('/profile', 'Profile\ProfileController@get')->name('profile');
    Route::post('/profile/edit', 'Profile\ProfileController@edit')->name('editProfile');
    Route::get('/profile/edit', 'Profile\ProfileController@showEdit')->name('showEditProfile');
    Route::post('/profile/password', 'Profile\ProfileController@editPassword')->name('editPassword');
    Route::get('/profile/password', 'Profile\ProfileController@showEditPassword')->name('showEditPassword');
    Route::group(['middleware' => []], function() {
        Route::post('/profile/changeRole', 'Profile\RoleChangeRequestController@create')->name('showCreateRoleChangeRequest');
        Route::get('/profile/changeRole', 'Profile\RoleChangeRequestController@showCreate')->name('createRoleChangeRequest');
    });
    Route::group(['middleware' => []], function() {
        Route::post('/profile/insertTeachingStudy', 'Profile\TeachingStudiesController@insert')->name('insertTeachingStudy');
        Route::post('/profile/removeTeachingStudy', 'Profile\TeachingStudiesController@remove')->name('removeTeachingStudy');
    });

    Route::post('/profile/changeNotificationProjects', 'Profile\NotificationsController@changeNotificationProjects')->name('changeNotificationProjects');
    Route::post('/profile/changeNotificationConvocations', 'Profile\NotificationsController@changeNotificationConvocations')->name('changeNotificationConvocations');
    Route::post('/profile/changeSubscription', 'Profile\SubscriptionController@changeSubscription')->name('changeSubscription');
    Route::group(['middleware' => []], function() {
        Route::post('/profile/createObservatoryRequest', 'Profile\ObservatoryRequestController@create')->name('createObservatoryRequest');
        Route::post('/profile/removeObservatoryRequest', 'Profile\ObservatoryRequestController@remove')->name('removeObservatoryRequest');
    });

//Users management
    Route::get('/users/{id}', 'Users\UserController@get')->name('user')->where('id', '[0-9]+');

    Route::group(['middleware' => []], function() {
        Route::get('/users', 'Users\UsersController@search')->name('searchUsers');
        Route::get('/observatory', 'Users\ObservatoryController@index')->name('observatory');
    });

    Route::group(['middleware' => []], function() {
        Route::post('/users/accept/{id}', 'Users\UserController@accept')->name('acceptUser')->where('id', '[0-9]+');
        Route::post('/users/reject/{id}', 'Users\UserController@reject')->name('rejectUser')->where('id', '[0-9]+');
        Route::post('/users/remove/{id}', 'Users\UserController@remove')->name('removeUser')->where('id', '[0-9]+');
        Route::get('/users/requests', 'Users\UsersController@registrationRequests')->name('registrationRequests');
        Route::get('/users/createOrganization', 'Users\OrganizationController@showCreate')->name('showCreateOrganization');
        Route::post('/users/createOrganizaction', 'Users\OrganizationController@create')->name('createOrganization');
        Route::get('/users/{id}/edit', 'Users\OrganizationController@showEdit')->name('showEditOrganization')->where('id', '[0-9]+');
        Route::post('/users/{id}/edit', 'Users\OrganizationController@edit')->name('editOrganization')->where('id', '[0-9]+');
        Route::get('/roleChanges', 'Users\RoleChangesController@all')->name('roleChanges');
        Route::get('/roleChanges/{id}', 'Users\RoleChangeController@get')->name('roleChange')->where('id', '[0-9]+');
        Route::post('/roleChanges/{id}/accept', 'Users\RoleChangeController@accept')->name('acceptRoleChange')->where('id', '[0-9]+');
        Route::post('/roleChanges/{id}/reject', 'Users\RoleChangeController@reject')->name('rejectRoleChange')->where('id', '[0-9]+');

        Route::post('/observatory/accept/{id}', 'Users\ObservatoryController@acceptRequest')->name('observatoryAcceptRequest')->where('id', '[0-9]+');
        Route::post('/observatory/reject/{id}', 'Users\ObservatoryController@rejectRequest')->name('observatoryRejectRequest')->where('id', '[0-9]+');
        Route::post('/observatory/remove/{id}', 'Users\ObservatoryController@removeMember')->name('observatoryRemoveMember')->where('id', '[0-9]+');
    });

//Studies and campuses management
    Route::group(['middleware' => []], function() {
        Route::get('/studies', 'Configuration\StudiesController@search')->name('searchStudies');
        Route::get('/campuses', 'Configuration\CampusesController@search')->name('searchCampuses');
        Route::get('/studies/create', 'Configuration\StudyController@showCreate')->name('showCreateStudy');
        Route::post('/studies/create', 'Configuration\StudyController@create')->name('createStudy');
        Route::get('/campuses/create', 'Configuration\CampusController@showCreate')->name('showCreateCampus');
        Route::post('/campuses/create', 'Configuration\CampusController@create')->name('createCampus');
        Route::get('/studies/{id}', 'Configuration\StudyController@get')->name('study')->where('id', '[0-9]+');
        Route::get('/campuses/{id}', 'Configuration\CampusController@get')->name('campus')->where('id', '[0-9]+');
        Route::post('/studies/{id}/changeInactive', 'Configuration\StudyController@changeInactive')->name('changeStudyToInactive')->where('id', '[0-9]+');
        Route::post('/studies/{id}/changeName', 'Configuration\StudyController@changeName')->name('changeStudyName')->where('id', '[0-9]+');
        Route::post('/studies/{id}/changeBranch', 'Configuration\StudyController@changeBranch')->name('changeStudyBranch')->where('id', '[0-9]+');
        Route::post('/studies/{id}/changeCampus', 'Configuration\StudyController@changeCampus')->name('changeStudyCampus')->where('id', '[0-9]+');
        Route::post('/campuses/{id}/changeInactive', 'Configuration\CampusController@changeInactive')->name('changeCampusToInactive')->where('id', '[0-9]+');
        Route::post('/campuses/{id}/changeName', 'Configuration\CampusController@changeName')->name('changeCampusName')->where('id', '[0-9]+');
        Route::post('/campuses/{id}/changeAbbreviation', 'Configuration\CampusController@changeAbbreviation')->name('changeCampusAbbreviation')->where('id', '[0-9]+');
    });

// Offers management
    Route::get('/offers/{id}', 'Offers\OfferController@get')->name('offer')->where('id', '[0-9]+');
    Route::get('/offers', 'Offers\OffersController@index')->name('offers');
    
    Route::group(['middleware' => []], function() {
        Route::get('/offers/create', 'Offers\OfferController@showCreate')->name('showCreateOffer');
        Route::post('/offers/create', 'Offers\OfferController@create')->name('createOffer');
        Route::group(['middleware' => []], function() {
            Route::post('/offers/createOfferManagedByArea', 'Offers\OfferController@createOfferManagedByArea')->name('createOfferManagedByArea');
        });
        Route::group(['middleware' => []], function() {
            Route::get('/offers/{id}/showEdit', 'Offers\OfferController@showEdit')->name('showEditOffer')->where('id', '[0-9]+');
            Route::post('/offers/{id}/edit', 'Offers\OfferController@edit')->name('editOffer')->where('id', '[0-9]+');
            Route::group(['middleware' => []], function() {
                Route::post('/offers/{id}/editOfferManagedByArea', 'Offers\OfferController@editOfferManagedByArea')->name('editOfferManagedByArea')->where('id', '[0-9]+');
            });
            Route::post('/offers/{id}/close', 'Offers\OfferController@close')->name('closeOffer')->where('id', '[0-9]+');
        });
        Route::get('/offers/openOffers', 'Offers\OffersController@myOpenOffers')->name('myOpenOffers');
        Route::get('/offers/closedOffers', 'Offers\OffersController@myClosedOffers')->name('myClosedOffers');
        Route::get('/offers/myOffers', 'Offers\OffersController@myOffers')->name('myOffers');
    });

    Route::group(['middleware' => []], function() {
        Route::get('/offers/newOffers', 'Offers\OffersController@newOffers')->name('newOffers');
        Route::get('/offers/offersWithProposal', 'Offers\ProposalsController@offersWithProposal')->name('offersWithProposal');
        Route::get('/offers/acceptedProposals', 'Offers\ProposalsController@acceptedProposals')->name('acceptedProposals');
        Route::get('/offers/approvedProposals', 'Offers\ProposalsController@approvedProposals')->name('approvedProposals');
    });


//Proposal management
    Route::group(['middleware' => []], function() {
        Route::group(['middleware' => []], function() {
            Route::post('/offers/{id}/createProposal', 'Offers\ProposalController@create')->name('createProposal')->where('id', '[0-9]+');
        });
        Route::group(['middleware' => []], function() {
            Route::post('/proposal/{id}/remove', 'Offers\ProposalController@remove')->name('removeProposal')->where('id', '[0-9]+');
        });
        Route::group(['middleware' => []], function() {
            Route::post('/proposal/{id}/accept', 'Offers\ProposalController@accept')->name('acceptProposal')->where('id', '[0-9]+');
        });
        Route::group(['middleware' => []], function() {
            Route::post('/proposal/{id}/cancel', 'Offers\ProposalController@cancel')->name('cancelProposal')->where('id', '[0-9]+');
        });
    });

    Route::group(['middleware' => []], function() {
        Route::post('/proposal/{id}/approve', 'Offers\ProposalController@approve')->name('approveProposal')->where('id', '[0-9]+');
        Route::post('/proposal/{id}/reject', 'Offers\ProposalController@reject')->name('rejectProposal')->where('id', '[0-9]+');
    });



// Projects management
    Route::get('/projects/{id}', 'Projects\ProjectController@get')->name('project')->where('id', '[0-9]+');
    Route::get('/projects', 'Projects\ProjectsController@index')->name('projects');

    Route::group(['middleware' => []], function() {
        Route::get('/projects/showCreate', 'Projects\ProjectController@showCreate')->name('showCreateProject');
        Route::post('/projects/create', 'Projects\ProjectController@create')->name('createProject');
    });
    Route::get('/projects/myProjects', 'Projects\ProjectsController@myProjects')->name('myProjects');
    Route::get('/projects/finishedProjects', 'Projects\ProjectsController@finishedProjects')->name('finishedProjects');

    Route::group(['middleware' => []], function() {
        Route::get('/projects/proposedProjects', 'Projects\ProjectsController@proposedProjects')->name('proposedProjects');
    });
    Route::group(['middleware' => []], function() {
        Route::get('/projects/{id}/showEdit', 'Projects\ProjectController@showEdit')->name('showEditProject')->where('id', '[0-9]+');
        Route::post('/projects/{id}/edit', 'Projects\ProjectController@edit')->name('editProject')->where('id', '[0-9]+');
        Route::post('/projects/{id}/finish', 'Projects\ProjectController@finish')->name('finishProject')->where('id', '[0-9]+');
        Route::post('/projects/{id}/remove', 'Projects\ProjectController@remove')->name('removeProject')->where('id', '[0-9]+');
    });
    //Inscriptions in project managements
    Route::group(['middleware' => []], function() {
        Route::post('/projects/{id}/createInscription', 'Projects\InscriptionInProjectController@create')->name('createInscriptionInProject')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => []], function() {
        Route::post('/inscriptionsInProject/{id}/remove', 'Projects\InscriptionInProjectController@remove')->name('removeInscriptionInProject')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => []], function() {
        Route::post('/inscriptionsInProject/{id}/accept', 'Projects\InscriptionInProjectController@accept')->name('acceptInscriptionInProject')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => []], function() {
        Route::post('/inscriptionsInProject/{id}/cancel', 'Projects\InscriptionInProjectController@cancel')->name('cancelInscriptionInProject')->where('id', '[0-9]+');
    });
// Convocatories management
    Route::get('/convocatories/{id}', 'Convocatories\ConvocatoryController@get')->name('convocatory')->where('id', '[0-9]+');
    Route::get('/convocatories', 'Convocatories\ConvocatoriesController@all')->name('convocatories');

    Route::group(['middleware' => []], function() {
        Route::get('/convocatories/create', 'Convocatories\ConvocatoryController@showCreate')->name('showCreateConvocatory');
        Route::post('/convocatories/create', 'Convocatories\ConvocatoryController@create')->name('createConvocatory');
        Route::group(['middleware' => []], function() {
            Route::get('/convocatories/{id}/showEdit', 'Convocatories\ConvocatoryController@showEdit')->name('showEditConvocatory')->where('id', '[0-9]+');
            Route::post('/convocatories/{id}/edit', 'Convocatories\ConvocatoryController@edit')->name('editConvocatory')->where('id', '[0-9]+');
            Route::post('/convocatories/{id}/closeConvocatory', 'Convocatories\ConvocatoryController@close')->name('closeConvocatory')->where('id', '[0-9]+');
        });
    });
    //Inscriptions management
    Route::group(['middleware' => []], function() {
        Route::post('/convocatories/{id}/createInscription', 'Convocatories\InscriptionController@create')->name('createInscription')->where('id', '[0-9]+');
        Route::post('/convocatories/{id}/removeInscription', 'Convocatories\InscriptionController@remove')->name('removeInscription')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => []], function() {
        Route::post('/inscriptions/{id}/edit', 'Convocatories\InscriptionController@edit')->name('editInscription')->where('idUser', '[0-9]+');
    });
// Files management
    Route::group(['middleware' => []], function() {
        Route::get('/avatars/upload/{idUser}', 'Files\AvatarController@showUpload')->name('showUploadAvatar')->where('idUser', '[0-9]+');
        Route::post('/avatars/upload/{idUser}', 'Files\AvatarController@upload')->name('uploadAvatar')->where('idUser', '[0-9]+');
    });
    Route::group(['middleware' => []], function() {
        Route::get('/curriculums/upload/{idUser}', 'Files\CurriculumController@showUpload')->name('showUploadCurriculum')->where('idUser', '[0-9]+');
        Route::post('/curriculums/upload/{idUser}', 'Files\CurriculumController@upload')->name('uploadCurriculum')->where('idUser', '[0-9]+');
    });

    Route::get('/avatars/{file}', 'Files\AvatarController@get')->name('getImage');
    Route::get('/curriculums/{file}', 'Files\CurriculumController@get')->name('getCurriculum');
});
