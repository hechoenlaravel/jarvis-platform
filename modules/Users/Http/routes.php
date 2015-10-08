<?php

Route::group(['prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
	Route::get('/', 'UsersController@index');
});