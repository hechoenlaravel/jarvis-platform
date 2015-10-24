<?php
Route::get('/', function () {
    return redirect()->to('dashboard');
});
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

