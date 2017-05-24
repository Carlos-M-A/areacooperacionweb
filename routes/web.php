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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
Route::get('/offers/openOffers', 'Offers\OffersController@openOffers')->name('openOffers');
Route::get('/offers/closedOffers', 'Offers\OffersController@closedOffers')->name('closedOffers');
Route::get('/offers/newOffers', 'Offers\ProposalsController@newOffers')->name('newOffers');
Route::get('/offers/notEvaluatedProposals', 'Offers\ProposalsController@notEvaluatedProposals')->name('notEvaluatedProposals');
Route::get('/offers/approvedProposals', 'Offers\ProposalsController@approvedProposals')->name('approvedProposals');
Route::get('/offers/rejectedProposals', 'Offers\ProposalsController@rejectedProposals')->name('rejectedProposals');
Route::get('/offers/cancelledProposals', 'Offers\ProposalsController@cancelledProposals')->name('cancelledProposals');

Route::get('/offers/{id}', 'Offers\OffersController@offer')->name('offer');
Route::get('/offers/{id}/showEditOffer', 'Offers\OffersController@showEditOffer')->name('showEditOffer');
Route::post('/offers/{id}/editOffer', 'Offers\OffersController@editOffer')->name('editOffer');
Route::post('/offers/{id}/close', 'Offers\OffersController@close')->name('closeOffer');
Route::post('/offers/{id}/remove', 'Offers\OffersController@remove')->name('removeOffer');

Route::post('/offers/{id}/createProposal', 'Offers\ProposalsController@create')->name('createProposal');
Route::post('/proposal/{id}/remove', 'Offers\ProposalsController@remove')->name('removeProposal');
Route::post('/proposal/{id}/approve', 'Offers\ProposalsController@approve')->name('approveProposal');
Route::post('/proposal/{id}/reject', 'Offers\ProposalsController@reject')->name('rejectProposal');
Route::post('/proposal/{id}/accept', 'Offers\ProposalsController@accept')->name('acceptProposal');
Route::post('/proposal/{id}/cancel', 'Offers\ProposalsController@cancel')->name('cancelProposal');

Route::get('/organizations/{id}', 'Users\OrganizationsController@organization')->name('organization');
