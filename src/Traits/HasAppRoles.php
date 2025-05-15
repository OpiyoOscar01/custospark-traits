<?php

namespace Custospark\Traits\Traits;

use Illuminate\Support\Collection;
use Custospark\Traits\Models\Role;

trait HasAppRoles
{
    public function assignRoleWithApp($roleName, $appId)
    {
        // Fetch the role for the given app_id
        $role = Role::where('name', $roleName)
            ->where('app_id', $appId)
            ->firstOrFail();  // Ensure it throws an exception if not found

        // Attach the role to the user
        $this->roles()->attach($role->id);

        return $this;
    }

    public function getAppRoleNames($appId): Collection
    {
        // Fetch role names for the given app_id
        return $this->roles()
            ->where('app_id', $appId)
            ->pluck('name');
    }

    public function revokeRoleFromApp($roleName, $appId)
    {
        // Find and detach the role for the given app_id
        $role = Role::where('name', $roleName)
            ->where('app_id', $appId)
            ->first();

        if ($role) {
            $this->roles()->detach($role->id);
        }

        return $this;
    }

    public function updateAppRole($oldRoleName, $newRoleName, $appId)
    {
        // Find the old role and update its name
        $role = Role::where('name', $oldRoleName)
            ->where('app_id', $appId)
            ->first();

        if ($role) {
            $role->name = $newRoleName;
            $role->save();
        }

        return $role;
    }

    public function deleteAppRole($roleName, $appId)
    {
        // Find and delete the role for the given app_id
        $role = Role::where('name', $roleName)
            ->where('app_id', $appId)
            ->first();

        if ($role) {
            $role->delete();
        }

        return true;
    }
}
