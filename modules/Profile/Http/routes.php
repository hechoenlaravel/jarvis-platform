<?php

Route::group(['prefix' => 'profile', 'namespace' => 'Modules\Profile\Http\Controllers'], function()
{
	Route::get('/', 'ProfileController@index');
});