<?php

namespace Modules\Users\Observers;


/**
 * Class RoleObserver
 * @package Modules\Users\Observers
 */
class RoleObserver
{

    /**
     * Set the name when is creating or updating before save
     * @param $model
     */
    public function saving($model)
    {
        $model->name = str_slug($model->display_name);
    }

}