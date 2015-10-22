<?php namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Role;
use Modules\Users\Entities\User;

class UsersDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
        factory(User::class, 300)->create()->each(function($u) {
            $role = Role::where('name', 'usuario-nivel-1')->first();
            $u->attachRole($role);
        });
	}

}