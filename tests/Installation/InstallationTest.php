<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class InstallationTest extends \Tests\TestCase
{

    use DatabaseMigrations;



    public function test_it_installs_the_platform()
    {
        $this->installApp();
        $this->assertDatabaseHas('app_entities', ['slug' => 'users']);
        $this->assertDatabaseHas('roles', ['name' => 'Administrador del sistema']);
        $this->assertDatabaseHas('users', ['email' => 'admin@admin.com']);
    }

}
