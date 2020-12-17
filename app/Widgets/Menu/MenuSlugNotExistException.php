<?php

namespace App\Widgets\Menu;

class MenuSlugNotExistException extends \Exception
{
    protected $message = 'Menu slag not exist.';

    public function __construct()
    {
        parent::__construct($this->message, 500);
    }
}
