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

Route::group(['prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
	Route::get('/', 'UsersController@index');
});