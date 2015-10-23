<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://jarvisplatform.dev';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Set Up the Application, it will install it.
     */
    public function setUp()
    {
        parent::setUp();
        if(!file_exists(storage_path('database.sqlite'))){
            $database = fopen(storage_path('database.sqlite'), "w");
            fclose($database);
        }
        $this->beforeApplicationDestroyed(function(){
            unlink(storage_path('database.sqlite'));
        });
    }

    public function installApp()
    {
        \Artisan::call('jplatform:install');
    }
}
