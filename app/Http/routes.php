<?php
Route::get('/', function () {
    return redirect()->to('home');
});
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

