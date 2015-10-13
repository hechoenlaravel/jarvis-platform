<?php namespace Modules\Users\Console;

use Illuminate\Console\Command;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\Role;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateDefaultRoleAndPerms extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'users:generateDefaultRoles';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate default roles and permissions for the system';

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
	 * This will create the User's permissions for module User
	 * @return mixed
	 */
	public function fire()
	{
        $admin = Role::create([
            'name' => 'administrator',
            'display_name' => 'Administrador del sistema',
            'description' => 'Administrador general del sistema'
        ]);
        $user = Role::create([
            'name' => 'user',
            'display_name' => 'Usuario nivel 1',
            'description' => 'Usuario general del sistema'
        ]);
        $create = Permission::create([
            'name' => 'user-create',
            'display_name' => 'Crear Usuarios',
            'description' => 'Crea usuarios en el sistema',
            'module' => 'users'
        ]);
        $edit = Permission::create([
            'name' => 'user-edit',
            'display_name' => 'Editar Usuarios',
            'description' => 'Edita usuarios en el sistema',
            'module' => 'users'
        ]);
        $delete = Permission::create([
            'name' => 'user-delete',
            'display_name' => 'Eliminar Usuarios',
            'description' => 'Elimina usuarios en el sistema',
            'module' => 'users'
        ]);
        $activate = Permission::create([
            'name' => 'user-activate',
            'display_name' => 'Activar/Desactivar Usuarios',
            'description' => 'Puede activar o desactivar usuarios en el sistema',
            'module' => 'users'
        ]);
        $config = Permission::create([
            'name' => 'user-configuration',
            'display_name' => 'Configuración de usuarios',
            'description' => 'Puede modificar la configuración del modulo, como los campos de perfil y otros.',
            'module' => 'users'
        ]);
        $admin->attachPermissions([$create, $edit, $delete, $activate, $config]);
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
