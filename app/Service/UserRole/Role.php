<?php

namespace App\Service\UserRole;

final class Role
{
    const ROLE_USER            = 'ROLE_USER';
    const ROLE_ADMIN           = 'ROLE_ADMIN';
    const ROLE_SUDO            = 'ROLE_SUDO';

    /**
     * @param string $role
     * @return array
     */
    public static function getAllowedRoles(string $role)
    {
        if (isset(config('roles')[$role])) {
            return config('roles')[$role];
        }

        return [];
    }

    /***
     * @return array
     */
    public static function getRoleList()
    {
        return config('roles');
    }
}
