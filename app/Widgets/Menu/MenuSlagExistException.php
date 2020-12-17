<?php

namespace App\Widgets\Menu;

class MenuSlagExistException extends \Exception
{
    protected $message = 'Menu slug exist.';

    public function __construct()
    {
        parent::__construct($this->message, 500);
    }
}
