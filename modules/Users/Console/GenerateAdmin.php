<?php namespace Modules\Users\Console;

use Illuminate\Console\Command;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Role;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateAdmin extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'users:generateAdmin';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a default Admin user';

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
	 * Creates the default user
	 * @return mixed
	 */
	public function fire()
	{
        $user = User::create([
            'name' => 'Administrador',
            'uuid' => \Uuid::generate(4),
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);
        $adminRole = Role::where('name', 'administrador-del-sistema')->first();
        $user->attachRole($adminRole);
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
