<?php

namespace App\Providers;

use App\Service\Pipedrive\CustomPipeDrive;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CustomPipeDriveServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::singleton('custom_pipe_drive', function() {
            return new CustomPipeDrive();
        });
    }
}
