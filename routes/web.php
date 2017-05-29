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
Route::post('/profile/changeRole', 'Profile\ProfileController@requestRoleChange')->name('requestRoleChange');
Route::get('/profile/changeRole', 'Profile\ProfileController@showRequestRoleChange')->name('showRequestRoleChange');

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
Route::get('/users/{id}', 'Users\UsersController@user')->where('id', '[0-9]+')->name('user');
Route::get('/users', 'Users\UsersController@index')->name('users');
Route::post('/users', 'Users\UsersController@search')->name('searchUsers');
Route::post('/users/accept/{id}', 'Users\UsersController@accept')->where('id', '[0-9]+')->name('acceptUser');
Route::post('/users/reject/{id}', 'Users\UsersController@reject')->where('id', '[0-9]+')->name('rejectUser');
Route::post('/users/remove/{id}', 'Users\UsersController@remove')->where('id', '[0-9]+')->name('removeUser');
Route::get('/users/requests', 'Users\UsersController@registrationRequests')->name('registrationRequests');
Route::get('/users/registerOrganization', 'Users\OrganizationsController@index')->name('showRegisterOrganization');
Route::post('/users/registerOrganizaction', 'Users\OrganizationsController@registerOrganization')->name('registerOrganization');
Route::get('/roleChanges', 'Users\RoleChangesController@index')->name('roleChanges');
Route::get('/roleChanges/{id}', 'Users\RoleChangesController@roleChange')->name('roleChange');
Route::post('/roleChanges/{id}/accept', 'Users\RoleChangesController@accept')->name('acceptRoleChange');
Route::post('/roleChanges/{id}/reject', 'Users\RoleChangesController@reject')->name('rejectRoleChange');

//Studies and faculties management
Route::get('/studies', 'Users\StudiesController@index')->name('studies');
Route::post('/studies', 'Users\StudiesController@search')->name('searchStudies');
Route::get('/faculties', 'Users\FacultiesController@index')->name('faculties');
Route::post('/faculties', 'Users\FacultiesController@search')->name('searchFaculties');
Route::get('/studies/createStudy', 'Users\StudiesController@showCreateStudy')->name('showCreateStudy');
Route::post('/studies/createStudy', 'Users\StudiesController@createStudy')->name('createStudy');
Route::get('/faculties/createFaculty', 'Users\FacultiesController@showCreateFaculty')->name('showCreateFaculty');
Route::post('/faculties/createFaculty', 'Users\FacultiesController@createFaculty')->name('createFaculty');
Route::get('/studies/{id}', 'Users\StudiesController@study')->name('study');
Route::get('/faculties/{id}', 'Users\FacultiesController@faculty')->name('faculty');
Route::post('/studies/{id}/changeInactive', 'Users\StudiesController@changeInactive')->name('changeStudyToInactive');
Route::post('/studies/{id}/changeName', 'Users\StudiesController@changeName')->name('changeStudyName');
Route::post('/studies/{id}/changeBranch', 'Users\StudiesController@changeBranch')->name('changeStudyBranch');
Route::post('/studies/{id}/changeFaculty', 'Users\StudiesController@changeFaculty')->name('changeStudyFaculty');
Route::post('/faculties/{id}/changeInactive', 'Users\FacultiesController@changeInactive')->name('changeFacultyToInactive');
Route::post('/faculties/{id}/changeName', 'Users\FacultiesController@changeName')->name('changeFacultyName');
Route::post('/faculties/{id}/changeCity', 'Users\FacultiesController@changeCity')->name('changeFacultyCity');

// Offers management
Route::get('/offers/createOffer', 'Offers\OffersController@showCreateOffer')->name('showCreateOffer');
Route::post('/offers/createOffer', 'Offers\OffersController@createOffer')->name('createOffer');
Route::post('/offers/createOfferManagedByArea', 'Offers\OffersController@createOfferManagedByArea')->name('createOfferManagedByArea');
Route::get('/offers/openOffers', 'Offers\OffersController@openOffers')->name('openOffers');
Route::get('/offers/closedOffers', 'Offers\OffersController@closedOffers')->name('closedOffers');
Route::get('/offers/newOffers', 'Offers\ProposalsController@newOffers')->name('newOffers');
Route::get('/offers/offersWithProposal', 'Offers\ProposalsController@offersWithProposal')->name('offersWithProposal');
Route::get('/offers/acceptedProposals', 'Offers\ProposalsController@acceptedProposals')->name('acceptedProposals');
Route::get('/organizations/{id}', 'Users\OrganizationsController@organization')->name('organization');


Route::get('/offers/{id}', 'Offers\OffersController@offer')->name('offer');
Route::get('/offers/{id}/showEditOffer', 'Offers\OffersController@showEditOffer')->name('showEditOffer');
Route::post('/offers/{id}/editOffer', 'Offers\OffersController@editOffer')->name('editOffer');
Route::post('/offers/{id}/editOfferManagedByArea', 'Offers\OffersController@editOfferManagedByArea')->name('editOfferManagedByArea');
Route::post('/offers/{id}/close', 'Offers\OffersController@close')->name('closeOffer');

//Proposal management
Route::post('/offers/{id}/createProposal', 'Offers\ProposalsController@create')->name('createProposal');

Route::post('/proposal/{id}/remove', 'Offers\ProposalsController@remove')->name('removeProposal');
Route::post('/proposal/{id}/approve', 'Offers\ProposalsController@approve')->name('approveProposal');
Route::post('/proposal/{id}/reject', 'Offers\ProposalsController@reject')->name('rejectProposal');
Route::post('/proposal/{id}/accept', 'Offers\ProposalsController@accept')->name('acceptProposal');
Route::post('/proposal/{id}/cancel', 'Offers\ProposalsController@cancel')->name('cancelProposal');



// Projects management
Route::get('/projects/myProjects', 'Projects\ProjectsController@myProjects')->name('myProjects');
Route::get('/projects/newProjects', 'Projects\ProjectsController@newProjectsWithoutTutor')->name('newProjects');
Route::get('/projects/myTutoredProjects', 'Projects\ProjectsController@myTutoredProjects')->name('myTutoredProjects');
Route::get('/projects/projectsWithTutelageProposal', 'Projects\ProjectsController@projectsWithTutelageProposal')->name('projectsWithTutelageProposal');
Route::get('/projects/{id}', 'Projects\ProjectsController@project')->name('project');
Route::get('/projects/{id}/showEditProject', 'Projects\ProjectsController@showEditProject')->name('showEditProject');
Route::post('/projects/{id}/editProject', 'Projects\ProjectsController@editProject')->name('editProject');
Route::post('/projects/{id}/enterTutorManually', 'Projects\ProjectsController@enterTutorManually')->name('enterTutorManually');
Route::post('/projects/{id}/terminate', 'Projects\ProjectsController@terminate')->name('terminateProject');
Route::post('/projects/{id}/createProposal', 'Projects\TutelageProposalsController@create')->name('createTutelageProposal');
Route::post('/tutelageProposal/{id}/remove', 'Projects\TutelageProposalsController@remove')->name('removeTutelageProposal');
Route::post('/tutelageProposal/{id}/accept', 'Projects\TutelageProposalsController@accept')->name('acceptTutelageProposal');

// Convocatories management
Route::get('/convocatories/createConvocatory', 'Convocatories\ConvocatoriesController@showCreateConvocatory')->name('showCreateConvocatory');
Route::post('/convocatories/createConvocatory', 'Convocatories\ConvocatoriesController@createConvocatory')->name('createConvocatory');
Route::get('/convocatories/{id}', 'Convocatories\ConvocatoriesController@convocatory')->name('convocatory');
Route::get('/convocatories', 'Convocatories\ConvocatoriesController@convocatories')->name('convocatories');
Route::get('/convocatories/{id}/showEditConvocatory', 'Convocatories\ConvocatoriesController@showEditConvocatory')->name('showEditConvocatory');
Route::post('/convocatories/{id}/editConvocatory', 'Convocatories\ConvocatoriesController@editConvocatory')->name('editConvocatory');
Route::post('/convocatories/{id}/closeConvocatory', 'Convocatories\ConvocatoriesController@close')->name('closeConvocatory');

Route::post('/convocatories/{id}/createInscription', 'Convocatories\InscriptionsController@createInscription')->name('createInscription');
Route::post('/convocatories/{id}/remove', 'Convocatories\InscriptionsController@remove')->name('removeInscription');
Route::post('/inscriptions/{id}/edit', 'Convocatories\InscriptionsController@edit')->name('editInscription');