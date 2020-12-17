<?php

namespace App\Widgets\Menu;

class MenuNotStartedException extends \Exception
{
    protected $message = 'Type - "->createMenu() method."';

    public function __construct()
    {
        parent::__construct($this->message, 500);
    }
}
