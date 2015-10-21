<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InstallationTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;

    public function test_it_installs_the_platform()
    {
        \Artisan::call('jplatform:install');
        $this->seeInDatabase('app_entities', ['slug' => 'users']);
        $this->seeInDatabase('app_roles', ['name' => 'administrator']);
        $this->seeInDatabase('app_users', ['email' => 'admin@admin.com']);
        $this->visit('/')->seePageIs('auth/login');
    }

}
