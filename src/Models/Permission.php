<?php

namespace Custospark\Traits\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $connection = 'auth_db';
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'guard_name', 'app_id'];
}
