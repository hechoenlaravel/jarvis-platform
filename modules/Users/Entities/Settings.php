<?php

namespace modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model{

    protected $table = "app_users_settings";

    protected $fillable = ['name', 'description', 'slug'];

}