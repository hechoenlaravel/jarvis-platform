<?php namespace Modules\Users\Console;

use Illuminate\Console\Command;
use Modules\Users\Repositories\EntitiesGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateEntities extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'users:generateEntities';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate the Entities for Users Module - Only used during installation.';

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
        $generator = new EntitiesGenerator();
        $generator->generate();
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
