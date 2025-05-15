<?php

namespace Custospark\Traits\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $connection = 'auth_db';
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'guard_name', 'app_id'];
}
