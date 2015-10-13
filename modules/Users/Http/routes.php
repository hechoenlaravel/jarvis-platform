<?php

/**
 * Auth Routes
 */
Route::group(['prefix' => 'auth', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/login', [
        'as' => 'login',
        'uses' => 'AuthController@login'
    ]);
    Route::post('/login', [
        'as' => 'login-post',
        'uses' => 'AuthController@postLogin'
    ]);
    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'AuthController@getLogout'
    ]);
});
/** Module Routes **/
Route::group(['namespace' => 'Modules\Users\Http\Controllers'], function()
{
	Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'create', 'edit']]);
    Route::get('config/users', ['as' => 'users.config', 'uses' => 'ConfigController@index']);
    Route::get('config/users/create-field', ['as' => 'users.config.create', 'uses' => 'ConfigController@createField']);
});
/** Module API Routes **/
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'Modules\Users\Http\Controllers'], function ($api) {
    $api->group(['prefix' => 'users'], function($api) {
        $api->post('find-users', 'UsersController@find');
        $api->delete('/{id}', 'UsersController@destroy');
    });
});