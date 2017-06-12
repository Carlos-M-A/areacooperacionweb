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


//Managemer of the homes
Route::get('/home', 'HomeController@index')->name('home');

// Profile management
Route::get('/profile', 'Profile\ProfileController@get')->name('profile');
Route::post('/profile/edit', 'Profile\ProfileController@edit')->name('editProfile');
Route::get('/profile/edit', 'Profile\ProfileController@showEdit')->name('showEditProfile');
Route::post('/profile/password', 'Profile\ProfileController@editPassword')->name('editPassword');
Route::get('/profile/password', 'Profile\ProfileController@showEditPassword')->name('showEditPassword');
Route::post('/profile/changeRole', 'Profile\RoleChangeRequestController@create')->name('showCreateRoleChangeRequest');
Route::get('/profile/changeRole', 'Profile\RoleChangeRequestController@showCreate')->name('createRoleChangeRequest');

Route::post('/profile/changeNotificationProjects', 'Profile\NotificationsController@changeNotificationProjects')->name('changeNotificationProjects');
Route::post('/profile/changeNotificationConvocations', 'Profile\NotificationsController@changeNotificationConvocations')->name('changeNotificationConvocations');
Route::post('/profile/changeSubscription', 'Profile\SubscriptionController@changeSubscription')->name('changeSubscription');
Route::post('/profile/createObservatoryRequest', 'Profile\ObservatoryRequestController@create')->name('createObservatoryRequest');
Route::post('/profile/removeObservatoryRequest', 'Profile\ObservatoryRequestController@remove')->name('removeObservatoryRequest');
Route::post('/profile/insertTeachingStudy', 'Profile\TeachingStudiesController@insert')->name('insertTeachingStudy');
Route::post('/profile/removeTeachingStudy', 'Profile\TeachingStudiesController@remove')->name('removeTeachingStudy');

//Users management
Route::get('/users/{id}', 'Users\UserController@get')->where('id', '[0-9]+')->name('user');
Route::get('/users', 'Users\UsersController@search')->name('searchUsers');
Route::post('/users/accept/{id}', 'Users\UserController@accept')->where('id', '[0-9]+')->name('acceptUser');
Route::post('/users/reject/{id}', 'Users\UserController@reject')->where('id', '[0-9]+')->name('rejectUser');
Route::post('/users/remove/{id}', 'Users\UserController@remove')->where('id', '[0-9]+')->name('removeUser');
Route::get('/users/requests', 'Users\UsersController@registrationRequests')->name('registrationRequests');
Route::get('/users/createOrganization', 'Users\OrganizationController@showCreate')->name('showCreateOrganization');
Route::post('/users/createOrganizaction', 'Users\OrganizationController@create')->name('createOrganization');
Route::get('/users/{id}/edit', 'Users\OrganizationController@showEdit')->name('showEditOrganization');
Route::post('/users/{id}/edit', 'Users\OrganizationController@edit')->name('editOrganization');
Route::get('/roleChanges', 'Users\RoleChangesController@all')->name('roleChanges');
Route::get('/roleChanges/{id}', 'Users\RoleChangeController@get')->name('roleChange');
Route::post('/roleChanges/{id}/accept', 'Users\RoleChangeController@accept')->name('acceptRoleChange');
Route::post('/roleChanges/{id}/reject', 'Users\RoleChangeController@reject')->name('rejectRoleChange');
Route::get('/observatory', 'Users\ObservatoryController@index')->name('observatory');
Route::post('/observatory/accept/{id}', 'Users\ObservatoryController@acceptRequest')->where('id', '[0-9]+')->name('observatoryAcceptRequest');
Route::post('/observatory/reject/{id}', 'Users\ObservatoryController@rejectRequest')->where('id', '[0-9]+')->name('observatoryRejectRequest');
Route::post('/observatory/remove/{id}', 'Users\ObservatoryController@removeMember')->where('id', '[0-9]+')->name('observatoryRemoveMember');

//Studies and faculties management
Route::get('/studies', 'Configuration\StudiesController@search')->name('searchStudies');
Route::get('/faculties', 'Configuration\FacultiesController@search')->name('searchFaculties');
Route::get('/studies/create', 'Configuration\StudyController@showCreate')->name('showCreateStudy');
Route::post('/studies/create', 'Configuration\StudyController@create')->name('createStudy');
Route::get('/faculties/create', 'Configuration\FacultyController@showCreate')->name('showCreateFaculty');
Route::post('/faculties/create', 'Configuration\FacultyController@create')->name('createFaculty');
Route::get('/studies/{id}', 'Configuration\StudyController@get')->name('study');
Route::get('/faculties/{id}', 'Configuration\FacultyController@get')->name('faculty');
Route::post('/studies/{id}/changeInactive', 'Configuration\StudyController@changeInactive')->name('changeStudyToInactive');
Route::post('/studies/{id}/changeName', 'Configuration\StudyController@changeName')->name('changeStudyName');
Route::post('/studies/{id}/changeBranch', 'Configuration\StudyController@changeBranch')->name('changeStudyBranch');
Route::post('/studies/{id}/changeFaculty', 'Configuration\StudyController@changeFaculty')->name('changeStudyFaculty');
Route::post('/faculties/{id}/changeInactive', 'Configuration\FacultyController@changeInactive')->name('changeFacultyToInactive');
Route::post('/faculties/{id}/changeName', 'Configuration\FacultyController@changeName')->name('changeFacultyName');
Route::post('/faculties/{id}/changeCity', 'Configuration\FacultyController@changeCity')->name('changeFacultyCity');

// Offers management
Route::get('/offers/create', 'Offers\OfferController@showCreate')->name('showCreateOffer');
Route::post('/offers/create', 'Offers\OfferController@create')->name('createOffer');
Route::post('/offers/createOfferManagedByArea', 'Offers\OfferController@createOfferManagedByArea')->name('createOfferManagedByArea');
Route::get('/offers/openOffers', 'Offers\OffersController@openOffers')->name('openOffers');
Route::get('/offers/closedOffers', 'Offers\OffersController@closedOffers')->name('closedOffers');
Route::get('/offers/newOffers', 'Offers\ProposalsController@newOffers')->name('newOffers');
Route::get('/offers/offersWithProposal', 'Offers\ProposalsController@offersWithProposal')->name('offersWithProposal');
Route::get('/offers/acceptedProposals', 'Offers\ProposalsController@acceptedProposals')->name('acceptedProposals');
Route::get('/organizations/{id}', 'Users\OrganizationsController@get')->name('organization');

Route::get('/offers/{id}', 'Offers\OfferController@get')->name('offer');
Route::get('/offers/{id}/showEdit', 'Offers\OfferController@showEdit')->name('showEditOffer');
Route::post('/offers/{id}/edit', 'Offers\OfferController@edit')->name('editOffer');
Route::post('/offers/{id}/editOfferManagedByArea', 'Offers\OfferController@editOfferManagedByArea')->name('editOfferManagedByArea');
Route::post('/offers/{id}/close', 'Offers\OfferController@close')->name('closeOffer');

//Proposal management
Route::post('/offers/{id}/createProposal', 'Offers\ProposalController@create')->name('createProposal');
Route::post('/proposal/{id}/remove', 'Offers\ProposalController@remove')->name('removeProposal');
Route::post('/proposal/{id}/approve', 'Offers\ProposalController@approve')->name('approveProposal');
Route::post('/proposal/{id}/reject', 'Offers\ProposalController@reject')->name('rejectProposal');
Route::post('/proposal/{id}/accept', 'Offers\ProposalController@accept')->name('acceptProposal');
Route::post('/proposal/{id}/cancel', 'Offers\ProposalController@cancel')->name('cancelProposal');


// Projects management
Route::get('/projects/showCreate', 'Projects\ProjectController@showCreate')->name('showCreateProject');
Route::post('/projects/create', 'Projects\ProjectController@create')->name('createProject');
Route::get('/projects/myProjects', 'Projects\ProjectsController@myProjects')->name('myProjects');
Route::get('/projects/proposedProjects', 'Projects\ProjectsController@proposedProjects')->name('proposedProjects');
Route::get('/projects/finishedProjects', 'Projects\ProjectsController@finishedProjects')->name('finishedProjects');

Route::get('/projects/{id}', 'Projects\ProjectController@get')->name('project');
Route::get('/projects/{id}/showEdit', 'Projects\ProjectController@showEdit')->name('showEditProject');
Route::post('/projects/{id}/edit', 'Projects\ProjectController@edit')->name('editProject');
Route::post('/projects/{id}/finish', 'Projects\ProjectController@finish')->name('finishProject');
Route::post('/projects/{id}/remove', 'Projects\ProjectController@remove')->name('removeProject');
Route::post('/projects/{id}/createInscription', 'Projects\InscriptionInProjectController@create')->name('createInscriptionInProject');
Route::post('/inscriptionsInProject/{id}/remove', 'Projects\InscriptionInProjectController@remove')->name('removeInscriptionInProject');
Route::post('/inscriptionsInProject/{id}/accept', 'Projects\InscriptionInProjectController@accept')->name('acceptInscriptionInProject');
Route::post('/inscriptionsInProject/{id}/cancel', 'Projects\InscriptionInProjectController@cancel')->name('cancelInscriptionInProject');

// Convocatories management
Route::get('/convocatories/create', 'Convocatories\ConvocatoryController@showCreate')->name('showCreateConvocatory');
Route::post('/convocatories/create', 'Convocatories\ConvocatoryController@create')->name('createConvocatory');
Route::get('/convocatories/{id}', 'Convocatories\ConvocatoryController@get')->name('convocatory');
Route::get('/convocatories', 'Convocatories\ConvocatoriesController@all')->name('convocatories');
Route::get('/convocatories/{id}/showEdit', 'Convocatories\ConvocatoryController@showEdit')->name('showEditConvocatory');
Route::post('/convocatories/{id}/edit', 'Convocatories\ConvocatoryController@edit')->name('editConvocatory');
Route::post('/convocatories/{id}/closeConvocatory', 'Convocatories\ConvocatoryController@close')->name('closeConvocatory');

Route::post('/convocatories/{id}/createInscription', 'Convocatories\InscriptionController@create')->name('createInscription');
Route::post('/convocatories/{id}/removeInscription', 'Convocatories\InscriptionController@remove')->name('removeInscription');
Route::post('/inscriptions/{id}/edit', 'Convocatories\InscriptionController@edit')->name('editInscription');

// Files management
Route::get('/avatars/upload/{idUser}', 'Files\AvatarController@showUpload')->name('showUploadAvatar');
Route::post('/avatars/upload/{idUser}', 'Files\AvatarController@upload')->name('uploadAvatar');
Route::get('/curriculums/upload/{idUser}', 'Files\CurriculumController@showUpload')->name('showUploadCurriculum');
Route::post('/curriculums/upload/{idUser}', 'Files\CurriculumController@upload')->name('uploadCurriculum');
Route::get('/avatars/{file}', 'Files\AvatarController@get')->name('getImage');
Route::get('/curriculums/{file}', 'Files\CurriculumController@get')->name('getCurriculum');