<?php

Route::group(['prefix' => 'installer', 'namespace' => 'Modules\Installer\Http\Controllers'], function()
{
    Route::get('/', [
        'as' => 'installerUrl',
        'uses' => 'InstallerController@index'
    ]);
    Route::post('/', [
        'as' => 'installerPost',
        'uses' => 'InstallerController@doInstall'
    ]);
});