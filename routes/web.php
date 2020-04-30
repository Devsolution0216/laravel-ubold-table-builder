<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::resource('customers', 'Admin\CustomersController');
    Route::post('customer/destroy/{id}', 'Admin\CustomersController@destroy');

    Route::resource('templates', 'Admin\TemplateController');
    Route::get('templates/show/{id}', 'Admin\TemplateController@show');
    Route::post('templates/destroy/{id}', 'Admin\TemplateController@destroy');

    Route::resource('logs', 'Admin\LogsController');
    Route::post('logs/destroy/{id}', 'Admin\LogsController@destroy');
});

Route::middleware(['auth'])->group(function(){
    Route::resource('datas', 'DatasController');
    Route::get('datas/{customerId}/create/{templateId}', 'DatasController@create');
    Route::post('datas/{customerId}/store/{templateId}', 'DatasController@store');
    Route::get('datas/{id}/edit/{customerId}/{templateId}', 'DatasController@edit');
    Route::post('datas/{id}/update/{customerId}/{templateId}', 'DatasController@update');
    Route::post('datas/{id}/destroy/{templateId}', 'DatasController@destroy');
    Route::get('getTemplates/{customerId}', 'DatasController@getTemplates');
    Route::get('/getDetails/{customerId}/{templateId}', 'DatasController@getDetails');
    Route::post('/saveDefault', 'DatasController@saveDefault');

});

Route::GET('hdata/{api_key}/{table}', 'DatasController@hdata');
