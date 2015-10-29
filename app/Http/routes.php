<?php
Route::get('/', function () {
    return redirect()->to(env('URI_AFTER_LOGIN', '/dashboard'));
});

