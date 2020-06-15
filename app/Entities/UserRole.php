<?php

namespace App\Entities;

use App\Role;
use App\User;

trait UserRole
{
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized');
        }
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized');
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->where('name', $roles)->first();
    }

    public function assignUserRole(User $user, int $type = null)
    {
        $name = null;
        switch ($type) {
            case 1:
                $name = 'Admin';
                break;
            case 2:
                $name = 'Junior';
                break;
            case 3:
                $name = 'Senior';
                break;
            case 4:
                $name = 'Core Team';
                break;
            default:
                $name = 'External';
                break;
        }
        $role = Role::where('name', $name)->first();
        $user->roles()->attach($role);
    }
}
