<?php

namespace Custospark\Traits\Models;
use Custospark\Traits\Models\Role;;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Traits\Custospark\Traits\App\Traits\HasAppPermissions;
use Custospark\Traits\Models\Plan;


class App extends Model
{
    /** @use HasFactory<\Database\Factories\AppFactory> */
    use HasFactory;
    protected $connection = 'auth_db';
    protected $table = 'apps';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'base_url',
        'icon_url',
        'description',
        'status',
    ];

    // Define relationships if any (e.g. One-to-many with plans, features)
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
    public function roles(){
        return $this->hasMany(Role::class);
    }
    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
