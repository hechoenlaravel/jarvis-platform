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
        $this->createUsersFields($this->createUsersEntity());
        $this->createRolesFields($this->createRolesEntity());
        $this->createPermissionsFields($this->createPermissionsEntity());
    }

    /**
     * Use the manager to create Fields
     * @param $fields
     */
    protected function createFields($fields)
    {
        foreach ($fields as $field) {
            $this->generateField($field);
        }
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

    /**
     * Create the Users fields
     * @param $entity
     */
    public function createUsersFields($entity)
    {
        $fields = [
            [
                'entity_id' => $entity->id,
                'name' => 'users:fields.name',
                'description' => 'users:fields.description',
                'slug' => 'name',
                'locked' => 1,
                'create_field' => 0,
                'type' => 'text',
                'required' => 1
            ],
            [
                'entity_id' => $entity->id,
                'name' => 'users:fields.email.name',
                'description' => 'users:fields.email.description',
                'slug' => 'email',
                'locked' => 1,
                'create_field' => 0,
                'type' => 'email',
                'required' => 1
            ]
        ];
        $this->createFields($fields);
    }

    /**
     * Create the roles entity
     * @return mixed
     */
    public function createRolesEntity()
    {
        $data = [
            'namespace' => 'app',
            'name' => 'users:roles_entity.name',
            'description' => 'users:roles_entity.description',
            'slug' => 'roles',
            'locked' => 1,
            'create_table' => 1
        ];
        $entity = $this->generateEntity($data);

        return $entity;
    }

    /**
     * create the roles fields
     * @param $entity
     */
    public function createRolesFields($entity)
    {
        $fields = [
            [
                'entity_id' => $entity->id,
                'name' => 'users:roles_fields.name.name',
                'description' => 'users:roles_fields.name.description',
                'slug' => 'name',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'text',
                'required' => 1
            ],
            [
                'entity_id' => $entity->id,
                'name' => 'users:roles_fields.slug.name',
                'description' => 'users:roles_fields.slug.description',
                'slug' => 'slug',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'slug',
                'required' => 1,
                'options' => [
                    'field_to_use' => 'name'
                ]
            ],
            [
                'entity_id' => $entity->id,
                'name' => 'users:roles_fields.description.name',
                'description' => 'users:roles_fields.description.description',
                'slug' => 'description',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'textarea',
                'required' => 1
            ]
        ];
        $this->createFields($fields);
    }

    /**
     * Create the permissions entity
     * @return mixed
     */
    public function createPermissionsEntity()
    {
        $data = [
            'namespace' => 'app',
            'name' => 'users:permissions_entity.name',
            'description' => 'users:permissions_entity.description',
            'slug' => 'permissions',
            'locked' => 1,
            'create_table' => 1
        ];
        $entity = $this->generateEntity($data);

        return $entity;
    }

    /**
     * create the permissions fields
     * @param $entity
     */
    public function createPermissionsFields($entity)
    {
        $fields = [
            [
                'entity_id' => $entity->id,
                'name' => 'users:permissions_fields.name.name',
                'description' => 'users:permissions_fields.name.description',
                'slug' => 'name',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'text',
                'required' => 1
            ],
            [
                'entity_id' => $entity->id,
                'name' => 'users:permissions_fields.module.name',
                'description' => 'users:permissions_fields.module.description',
                'slug' => 'module_id',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'text',
                'required' => 1,
                'default' => $this->module->getStudlyName()
            ],
            [
                'entity_id' => $entity->id,
                'name' => 'users:permissions_fields.slug.name',
                'description' => 'users:permissions_fields.slug.description',
                'slug' => 'slug',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'slug',
                'required' => 1,
                'options' => [
                    'field_to_use' => 'name'
                ]
            ],
            [
                'entity_id' => $entity->id,
                'name' => 'users:permissions_fields.description.name',
                'description' => 'users:permissions_fields.description.description',
                'slug' => 'description',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'textarea',
                'required' => 1
            ]
        ];
        $this->createFields($fields);
    }

}