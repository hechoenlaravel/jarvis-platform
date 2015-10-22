<?php

namespace Modules\Users\Transformers;

use Modules\Users\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package Modules\Users\Transformers
 */
class UserTransformer extends TransformerAbstract{

    protected $defaultIncludes = ['roles'];

    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => (int) $user->id,
            'uuid' => $user->uuid,
            'name' => $user->name,
            'email' => $user->email,
            'active' => [
                'bool' => (bool)$user->active,
                'formatted' => ((bool)$user->active) ? "Activo" : "Inactivo"
            ],
            'links' => [
                'edit' => route('users.edit', ['id' => $user->uuid])
            ]
        ];
    }

    public function includeRoles(User $user)
    {
        if($user->roles->count() === 0)
        {
            return null;
        }
        return $this->collection($user->roles, new RoleTransformer());
    }

}