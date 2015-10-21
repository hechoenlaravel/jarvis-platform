<?php

namespace Modules\Users\Observers;

use Webpatser\Uuid\Uuid;

/**
 * Class UserObserver
 * @package Modules\Users\Observers
 */
class UserObserver {

    /**
     * When creating a user, please set a uuid. and encrypt the password
     * @param $model
     * @throws \Exception
     */
    public function creating($model)
    {
        $model->uuid = Uuid::generate(4);
        $model->password = bcrypt($model->password);
    }

}