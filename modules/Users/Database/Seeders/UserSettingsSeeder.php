<?php

namespace modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use modules\Users\Entities\Settings;
use Illuminate\Database\Eloquent\Model;

class UserSettingsSeeder extends Seeder{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

    }

}