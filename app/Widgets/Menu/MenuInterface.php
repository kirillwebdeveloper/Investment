<?php

namespace App\Widgets\Menu;

interface MenuInterface
{
    public function __toString();

    public function getSlug();

    public function getTemplatePath();

    public function getItems();

    public function addItem(MenuItemInterface $item);
}
