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
            'display_name' => 'Administrador del sistema',
            'description' => 'Administrador general del sistema'
        ]);
        $user = Role::create([
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
        $profileFields = Permission::create([
            'name' => 'user-profile-fields-edit',
            'display_name' => 'Editar campos del perfil de usuario',
            'description' => 'Administrat los campos del perfil de usuario',
            'module' => 'users'
        ]);
        $createRoles = Permission::create([
            'name' => 'create-role',
            'display_name' => 'Crear Roles',
            'description' => 'Puede crear roles en el sistema.',
            'module' => 'users'
        ]);
        $editRoles = Permission::create([
            'name' => 'edit-role',
            'display_name' => 'Editar Roles',
            'description' => 'Puede editar roles en el sistema.',
            'module' => 'users'
        ]);
        $deleteRoles = Permission::create([
            'name' => 'delete-role',
            'display_name' => 'Eliminar Roles',
            'description' => 'Puede eliminar roles en el sistema.',
            'module' => 'users'
        ]);
        $adminPermissions = Permission::create([
            'name' => 'admin-permissions',
            'display_name' => 'Administrar permisos',
            'description' => 'Puede adminisrar los permisos asignados a los roles.',
            'module' => 'users'
        ]);
        $admin->attachPermissions([$create, $edit, $delete, $activate, $config, $profileFields, $createRoles, $editRoles, $deleteRoles, $adminPermissions]);
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
