<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';

	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {

	/* ================== Dashboard ================== */

	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');

	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');

	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');

	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');

	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');

	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');

	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');

	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Clients ================== */
	Route::resource(config('laraadmin.adminRoute') . '/clients', 'LA\ClientsController');
	Route::get(config('laraadmin.adminRoute') . '/client_dt_ajax', 'LA\ClientsController@dtajax');

	/* ================== Events ================== */
	Route::resource(config('laraadmin.adminRoute') . '/events', 'LA\EventsController');
	Route::get(config('laraadmin.adminRoute') . '/event_dt_ajax', 'LA\EventsController@dtajax');
		/* ============== Event Days ============== */

	Route::get(config('laraadmin.adminRoute') . '/events/{eventId}/days', 'LA\EventsController@getDays')->name('days');
	Route::get(config('laraadmin.adminRoute') . '/events/{eventId}/days/{dayId}/create','LA\SessionsController@createSession')->name('createSession');

	/* =========== Event Sessions Day =========== */
	Route::get(config('laraadmin.adminRoute') . '/events/{eventId}/days/{dayId}/sessions', 'LA\SessionsController@getSessions')->name('sessions');
	Route::get(config('laraadmin.adminRoute') . '/events/{eventId}/days/{dayId}/sessions/create','LA\SessionsController@createSession')->name('createSession');
	Route::get(config('laraadmin.adminRoute') . '/events/{eventId}/days/{dayId}/sessions/{session_id}/edit','LA\SessionsController@editSession')->name('editSession');
	Route::get(config('laraadmin.adminRoute') . '/events/{eventId}/days/{dayId}/sessions/{session_id}','LA\SessionsController@showSession')->name('showSession');
	Route::post(config('laraadmin.adminRoute') . '/events/{eventId}/days/{dayId}/sessions','LA\SessionsController@storeSession')->name('storeSession');
	Route::patch(config('laraadmin.adminRoute') . '/events/{eventId}/days/{dayId}/sessions/{session_id}','LA\SessionsController@updateSession')->name('updateSession');
	Route::delete(config('laraadmin.adminRoute') . '/events/{eventId}/days/{dayId}/sessions/{session_id}','LA\SessionsController@destroySession')->name('destroySession');


	/* ============== Event Participants ============== */
	Route::get(config('laraadmin.adminRoute') . '/events/{eventId}/participants', 'LA\EventsController@participants')->name('participants');
	Route::get(config('laraadmin.adminRoute') . '/events/{eventId}/participants/{id}', 'LA\EventsController@accept')->name('accept');


	/* ================== Organisers ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organisers', 'LA\OrganisersController');
	Route::get(config('laraadmin.adminRoute') . '/organiser_dt_ajax', 'LA\OrganisersController@dtajax');

	/* ================== Participations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/participations', 'LA\ParticipationsController');
	Route::get(config('laraadmin.adminRoute') . '/participation_dt_ajax', 'LA\ParticipationsController@dtajax');

	/* ================== Days ================== */
	Route::resource(config('laraadmin.adminRoute') . '/days', 'LA\DaysController');
	Route::get(config('laraadmin.adminRoute') . '/day_dt_ajax', 'LA\DaysController@dtajax');

	/* ================== Sessions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/sessions', 'LA\SessionsController');
	Route::get(config('laraadmin.adminRoute') . '/session_dt_ajax', 'LA\SessionsController@dtajax');
});
