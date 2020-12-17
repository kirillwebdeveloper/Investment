<?php

namespace App\Providers;

use App\Service\Option\OptionManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class OptionServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::bind('options', function() {
            return OptionManager::getInstance();
        });
    }
}
