<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InstallationTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;

    public function test_it_installs_the_platform()
    {
        $this->installApp();
        $this->seeInDatabase('app_entities', ['slug' => 'users']);
        $this->seeInDatabase('app_roles', ['name' => 'administrador-del-sistema']);
        $this->seeInDatabase('app_users', ['email' => 'admin@admin.com']);
    }

    public function test_it_opens_auth_screen()
    {
        $this->installApp();
        $this->visit('/')->seePageIs('auth/login');
    }

}
