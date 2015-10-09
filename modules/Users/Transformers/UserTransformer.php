<?php

namespace Modules\Users\Transformers;

use Modules\Users\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package Modules\Users\Transformers
 */
class UserTransformer extends TransformerAbstract{

    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => (int) $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'links' => [
                'edit' => route('users.edit', ['id' => $user->id])
            ]
        ];
    }

}