<?php

namespace App\Widgets\Menu;

interface MenuWidgetInterface
{
    public function createMenu(MenuInterface $menu);

    public function endMenu();

    public function addItem(MenuItem $item);
}
