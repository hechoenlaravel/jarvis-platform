<?php

namespace JarvisPlatform\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Install extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'jplatform:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Jarvis Platform.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Welcome to the Jarvis platform Installer. Please wait while we set up the application.');
        $this->info('Generating Application Key');
        $this->call('key:generate');
        $this->info('Generating Entities for Modules');
        $this->call('users:generateEntities');
        $this->info('Generating Default Roles');
        $this->call('users:generateDefaultRoles');
        $this->info('Generating Default user');
        $this->call('users:generateAdmin');
        $this->info('Installing Dashboard Module');
        $this->call('dashboard:install');
        $this->info('Updating .env file');
        if(file_exists('.env')){
            $str = file_get_contents('.env');
            $str = str_replace("APP_INSTALLED=false", "APP_INSTALLED=true",$str);
            file_put_contents('.env', $str);
        }
        $this->info('This is all for now!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [

        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }

}
