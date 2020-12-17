<?php

namespace App\Providers;

use App\Service\Repository\BaseRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::singleton('repository', function() {
            return new BaseRepository();
        });
    }
}
