<?php

namespace Modules\Users\Repositories;

use Hechoenlaravel\JarvisFoundation\Traits\EntityManager;
use Pingpong\Modules\Facades\Module;

/**
 * Class EntitiesGenerator
 * @author Jose Luis Fonseca <jose@ditecnologia.com>
 * @package Modules\Users\Repositories
 */
class EntitiesGenerator
{

    use EntityManager;

    /**
     * The module
     * @var
     */
    protected $module;

    /**
     *
     */
    public function __construct()
    {
        $this->module = Module::find('users');
    }

    /**
     * Generate the Entities and fields for the users module
     */
    public function generate()
    {
        $this->createUsersEntity();
    }

    /**
     * Create the users entity
     * @return mixed
     */
    public function createUsersEntity()
    {
        $data = [
            'namespace' => 'app',
            'name' => 'users:entity.users.name',
            'description' => 'users:entity.users.description',
            'slug' => 'users',
            'locked' => 1,
            'create_table' => 0
        ];
        $entity = $this->generateEntity($data);

        return $entity;
    }

}