<?php

namespace App\Providers;

use App\Http\Middleware\CheckUserRole;
use App\Service\UserRole\RoleChecker;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

class CheckUserRoleProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CheckUserRole::class, function(Application $app) {
            return new CheckUserRole(
                $app->make(RoleChecker::class)
            );
        });
    }
}
