<?php namespace Modules\Installer\Console;

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
    public function fire()
    {
        $this->info('Welcome to the Jarvis platform Installer. Please wait while we set up the application.');
        $this->info('Generating Application Key');
        $this->call('key:generate');
        $this->info('Migrating Database');
        $this->call('migrate');
        $this->info('Generating Entities for Modules');
        $this->call('users:generateEntities');
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
