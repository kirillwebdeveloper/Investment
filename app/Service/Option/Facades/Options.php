<?php

namespace App\Service\Option\Facades;

use App\Service\Option\OptionModelInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Service\Option\OptionManager get($slug, $fieldName)
 * @method static \App\Service\Option\OptionManager save(OptionModelInterface $model)
 */
class Options extends Facade
{
    protected static function getFacadeAccessor() { return 'options'; }
}
