<?php

namespace Modules\Users\Entities;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole{

    protected $fillable = ['name', 'description', 'display_name'];

}