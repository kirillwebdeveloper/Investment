<?php

namespace App\Providers;

use App\Widgets\BaseWidget;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $file = app_path('Widgets/widgets.php');

        if (file_exists($file)) {
            include $file;
        }

        Blade::directive('widget', function ($name) {
            return "<?php echo app('widget')->show($name); ?>";
        });

        $this->loadViewsFrom(resource_path() .'/views/widgets', 'Widgets');
    }

    public function register()
    {
        App::singleton('widget', function() {
            return new BaseWidget();
        });
    }
}
