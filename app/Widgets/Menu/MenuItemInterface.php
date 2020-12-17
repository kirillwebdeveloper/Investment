<?php

namespace App\Widgets\Menu;

interface MenuItemInterface
{
    public function __toString();

    public function getUrl();

    public function getRouteName();
}
