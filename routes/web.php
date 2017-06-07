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
Route::get('/home/student', 'Home\HomeStudentController@index')->name('homeStudent');
Route::get('/home/teacher', 'Home\HomeTeacherController@index')->name('homeTeacher');
Route::get('/home/other', 'Home\HomeOtherController@index')->name('homeOther');
Route::get('/home/organization', 'Home\HomeOrganizationController@index')->name('homeOrganization');
Route::get('/home/cooperationArea', 'Home\HomeCooperationAreaController@index')->name('homeCooperationArea');
Route::get('/home/admin', 'Home\HomeAdminController@index')->name('homeAdmin');

// Profile management
Route::get('/profile', 'Profile\ProfileController@index')->name('profile');
Route::post('/profile/edit', 'Profile\ProfileController@edit')->name('editProfile');
Route::get('/profile/edit', 'Profile\ProfileController@showEdit')->name('showEditProfile');
Route::post('/profile/password', 'Profile\ProfileController@editPassword')->name('editPassword');
Route::get('/profile/password', 'Profile\ProfileController@showEditPassword')->name('showEditPassword');
Route::post('/profile/changeRole', 'Profile\RequestRoleChangeController@requestRoleChange')->name('requestRoleChange');
Route::get('/profile/changeRole', 'Profile\RequestRoleChangeController@showRequestRoleChange')->name('showRequestRoleChange');
Route::get('/profile/avatar', 'Files\ImagesController@showUploadAvatar')->name('showUploadAvatar');
Route::post('/profile/avatar', 'Files\ImagesController@upload')->name('uploadAvatar');
Route::get('/profile/curriculum', 'Files\CurriculumsController@showUploadCurriculum')->name('showUploadCurriculum');
Route::post('/profile/curriculum', 'Files\CurriculumsController@upload')->name('uploadCurriculum');

//More profile management
Route::post('/profile/changeNotificationProjects', 'Profile\NotificationsController@changeNotificationProjects')->name('changeNotificationProjects');
Route::post('/profile/changeNotificationConvocations', 'Profile\NotificationsController@changeNotificationConvocations')->name('changeNotificationConvocations');
Route::post('/profile/changeSubscription', 'Profile\SubscriptionController@changeSubscription')->name('changeSubscription');
Route::post('/profile/requestBeObservatoryMember', 'Profile\ObservatoryRequestController@requestBeObservatoryMember')->name('requestBeObservatoryMember');
Route::post('/profile/removeBeObservatoryMember', 'Profile\ObservatoryRequestController@removeBeObservatoryMember')->name('removeBeObservatoryMember');
Route::post('/profile/insertTeachingStudy', 'Profile\TeachingStudiesController@insertTeachingStudy')->name('insertTeachingStudy');
Route::post('/profile/removeTeachingStudy', 'Profile\TeachingStudiesController@removeTeachingStudy')->name('removeTeachingStudy');

//Observatory management
Route::get('/observatory', 'Users\ObservatoryController@index')->name('observatory');
Route::post('/observatory/accept/{id}', 'Users\ObservatoryController@acceptRequest')->where('id', '[0-9]+')->name('observatoryAccept');
Route::post('/observatory/reject/{id}', 'Users\ObservatoryController@rejectRequest')->where('id', '[0-9]+')->name('observatoryReject');
Route::post('/observatory/remove/{id}', 'Users\ObservatoryController@removeMember')->where('id', '[0-9]+')->name('observatoryRemove');

//Users management
Route::get('/users/{id}', 'Users\UserController@user')->where('id', '[0-9]+')->name('user');
Route::get('/users', 'Users\UsersController@index')->name('users');
Route::post('/users', 'Users\UsersController@search')->name('searchUsers');
Route::post('/users/accept/{id}', 'Users\UserController@accept')->where('id', '[0-9]+')->name('acceptUser');
Route::post('/users/reject/{id}', 'Users\UserController@reject')->where('id', '[0-9]+')->name('rejectUser');
Route::post('/users/remove/{id}', 'Users\UserController@remove')->where('id', '[0-9]+')->name('removeUser');
Route::get('/users/requests', 'Users\UsersController@registrationRequests')->name('registrationRequests');
Route::get('/users/registerOrganization', 'Users\OrganizationController@showRegisterOrganization')->name('showRegisterOrganization');
Route::post('/users/registerOrganizaction', 'Users\OrganizationController@registerOrganization')->name('registerOrganization');
Route::get('/users/{id}/editOrganization', 'Users\OrganizationController@showEditOrganization')->name('showEditOrganization');
Route::post('/users/{id}/editOrganizaction', 'Users\OrganizationController@editOrganization')->name('editOrganization');
Route::get('/roleChanges', 'Users\RoleChangesController@index')->name('roleChanges');
Route::get('/roleChanges/{id}', 'Users\RoleChangeController@roleChange')->name('roleChange');
Route::post('/roleChanges/{id}/accept', 'Users\RoleChangeController@accept')->name('acceptRoleChange');
Route::post('/roleChanges/{id}/reject', 'Users\RoleChangeController@reject')->name('rejectRoleChange');

//Studies and faculties management
Route::get('/studies', 'Users\StudiesController@index')->name('studies');
Route::post('/studies', 'Users\StudiesController@search')->name('searchStudies');
Route::get('/faculties', 'Users\FacultiesController@index')->name('faculties');
Route::post('/faculties', 'Users\FacultiesController@search')->name('searchFaculties');
Route::get('/studies/createStudy', 'Users\StudyController@showCreateStudy')->name('showCreateStudy');
Route::post('/studies/createStudy', 'Users\StudyController@createStudy')->name('createStudy');
Route::get('/faculties/createFaculty', 'Users\FacultyController@showCreateFaculty')->name('showCreateFaculty');
Route::post('/faculties/createFaculty', 'Users\FacultyController@createFaculty')->name('createFaculty');
Route::get('/studies/{id}', 'Users\StudyController@study')->name('study');
Route::get('/faculties/{id}', 'Users\FacultyController@faculty')->name('faculty');
Route::post('/studies/{id}/changeInactive', 'Users\StudyController@changeInactive')->name('changeStudyToInactive');
Route::post('/studies/{id}/changeName', 'Users\StudyController@changeName')->name('changeStudyName');
Route::post('/studies/{id}/changeBranch', 'Users\StudyController@changeBranch')->name('changeStudyBranch');
Route::post('/studies/{id}/changeFaculty', 'Users\StudyController@changeFaculty')->name('changeStudyFaculty');
Route::post('/faculties/{id}/changeInactive', 'Users\FacultyController@changeInactive')->name('changeFacultyToInactive');
Route::post('/faculties/{id}/changeName', 'Users\FacultyController@changeName')->name('changeFacultyName');
Route::post('/faculties/{id}/changeCity', 'Users\FacultyController@changeCity')->name('changeFacultyCity');

// Offers management
Route::get('/offers/createOffer', 'Offers\OfferController@showCreateOffer')->name('showCreateOffer');
Route::post('/offers/createOffer', 'Offers\OfferController@createOffer')->name('createOffer');
Route::post('/offers/createOfferManagedByArea', 'Offers\OfferController@createOfferManagedByArea')->name('createOfferManagedByArea');
Route::get('/offers/openOffers', 'Offers\OffersController@openOffers')->name('openOffers');
Route::get('/offers/closedOffers', 'Offers\OffersController@closedOffers')->name('closedOffers');
Route::get('/offers/newOffers', 'Offers\ProposalsController@newOffers')->name('newOffers');
Route::get('/offers/offersWithProposal', 'Offers\ProposalsController@offersWithProposal')->name('offersWithProposal');
Route::get('/offers/acceptedProposals', 'Offers\ProposalsController@acceptedProposals')->name('acceptedProposals');
Route::get('/organizations/{id}', 'Users\OrganizationsController@organization')->name('organization');


Route::get('/offers/{id}', 'Offers\OfferController@offer')->name('offer');
Route::get('/offers/{id}/showEditOffer', 'Offers\OfferController@showEditOffer')->name('showEditOffer');
Route::post('/offers/{id}/editOffer', 'Offers\OfferController@editOffer')->name('editOffer');
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
Route::get('/projects/showCreateProject', 'Projects\ProjectController@showCreateProject')->name('showCreateProject');
Route::post('/projects/createProject', 'Projects\ProjectController@createProject')->name('createProject');
Route::get('/projects/myProjects', 'Projects\ProjectsController@myProjects')->name('myProjects');
Route::get('/projects/openProjects', 'Projects\ProjectsController@openProjects')->name('openProjects');

Route::get('/projects/{id}', 'Projects\ProjectController@project')->name('project');
Route::get('/projects/{id}/showEditProject', 'Projects\ProjectController@showEditProject')->name('showEditProject');
Route::post('/projects/{id}/editProject', 'Projects\ProjectController@editProject')->name('editProject');
Route::post('/projects/{id}/finish', 'Projects\ProjectController@finish')->name('finishProject');
Route::post('/projects/{id}/createInscription', 'Projects\InscriptionInProjectController@create')->name('createInscriptionInProject');
Route::post('/inscriptionsInProject/{id}/remove', 'Projects\InscriptionInProjectController@remove')->name('removeInscriptionInProject');
Route::post('/inscriptionsInProject/{id}/accept', 'Projects\InscriptionInProjectController@accept')->name('acceptInscriptionInProject');
Route::post('/inscriptionsInProject/{id}/cancel', 'Projects\InscriptionInProjectController@cancel')->name('cancelInscriptionInProject');

// Convocatories management
Route::get('/convocatories/createConvocatory', 'Convocatories\ConvocatoryController@showCreateConvocatory')->name('showCreateConvocatory');
Route::post('/convocatories/createConvocatory', 'Convocatories\ConvocatoryController@createConvocatory')->name('createConvocatory');
Route::get('/convocatories/{id}', 'Convocatories\ConvocatoryController@convocatory')->name('convocatory');
Route::get('/convocatories', 'Convocatories\ConvocatoriesController@convocatories')->name('convocatories');
Route::get('/convocatories/{id}/showEditConvocatory', 'Convocatories\ConvocatoryController@showEditConvocatory')->name('showEditConvocatory');
Route::post('/convocatories/{id}/editConvocatory', 'Convocatories\ConvocatoryController@editConvocatory')->name('editConvocatory');
Route::post('/convocatories/{id}/closeConvocatory', 'Convocatories\ConvocatoryController@close')->name('closeConvocatory');

Route::post('/convocatories/{id}/createInscription', 'Convocatories\InscriptionController@createInscription')->name('createInscription');
Route::post('/convocatories/{id}/remove', 'Convocatories\InscriptionController@remove')->name('removeInscription');
Route::post('/inscriptions/{id}/edit', 'Convocatories\InscriptionController@edit')->name('editInscription');

// Files management
Route::get('/images/{file}', 'Files\ImagesController@get')->name('getImage');
Route::get('/curriculums/{file}', 'Files\CurriculumsController@get')->name('getImage');