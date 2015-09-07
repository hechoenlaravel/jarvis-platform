<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InstallationTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * It is able to install laravel admin
     *
     * @return void
     */
    public function test_checks_installation_status()
    {
        if (env('APP_INSTALLED', false) === false) {
            $this->visit('/')
                ->seePageIs('/installer');
        } else {
            $this->visit('/')
                ->seePageIs('/');
        }
    }

}
