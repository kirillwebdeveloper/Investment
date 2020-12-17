<?php

namespace App\Widgets\Menu;

class Menu implements MenuInterface
{
    private $slug;

    private $templatePath;

    private $items = [];

    public function __construct($slug, $templatePath)
    {
        $this->slug          = $slug;
        $this->templatePath  = $templatePath;
    }

    public function __toString()
    {
        return $this->slug;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addItem(MenuItemInterface $item)
    {
        array_push($this->items, $item);

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getTemplatePath()
    {
        return $this->templatePath;
    }
}
