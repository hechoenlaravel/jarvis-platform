<?php

namespace Modules\Users\Entities;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission{

    protected $fillable = ['name', 'description', 'display_name', 'module'];

}