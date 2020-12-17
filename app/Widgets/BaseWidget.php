<?php

namespace App\Widgets;

use App\Widgets\Contract\ContractWidget;

class BaseWidget
{
    protected $widgets;

    public function __construct()
    {
        $this->widgets = config('widgets');
    }

    public function show($obj, $params =[])
    {
        app()->get($this->widgets[$obj])->setParams($params);

        return app()->get($this->widgets[$obj])->execute();
    }

    public function get($obj)
    {
        $this->boot($obj);

        return app()->get($this->widgets[$obj]);
    }

    public function boot($obj, $params = [])
    {
        if(isset($this->widgets[$obj])) {
            /** @var ContractWidget $obj */
            app()->singleton($this->widgets[$obj], function () use ($obj, $params) {
                $instance = new $this->widgets[$obj]();

                if (!empty($params)) $instance->setParams($params);

                return $instance;
            });

            return app()->get($this->widgets[$obj]);
        }
    }
}
