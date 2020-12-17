<?php

namespace App\Providers;

use App\Service\Manager\Contact\ContactMessageManager;
use App\Service\Repository\BaseRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ContactMessageManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::bind('contact_message_manager', function(Application $app) {
            return new ContactMessageManager($app->get(BaseRepository::class));
        });
    }
}
