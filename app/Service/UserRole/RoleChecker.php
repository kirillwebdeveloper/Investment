<?php

namespace App\Service\UserRole;

use App\Entity\User;

class RoleChecker
{
    /**
     * @param User $user
     * @param string $role
     * @return bool
     */
    public function check(User $user, string $role)
    {
        if ($user->hasRole(Role::ROLE_SUDO)) {
            return true;
        }

        else if($user->hasRole(Role::ROLE_ADMIN)) {
            $managementRoles = Role::getAllowedRoles(Role::ROLE_ADMIN);

            if (in_array($role, $managementRoles)) {
                return true;
            }
        }

        return $user->hasRole($role);
    }
}
