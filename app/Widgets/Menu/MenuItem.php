<?php

namespace App\Widgets\Menu;

class MenuItem implements MenuItemInterface
{
    private $routeName;

    private $routeUrl;

    private $label;

    private $blank;

    private $classes = [];

    public function __construct($routeName, $label, $classes = [], $routeUrl = null, $blank = false)
    {
        $this->routeName = $routeName;
        $this->routeUrl  = $routeUrl;
        $this->label     = $label;
        $this->classes   = $classes;
        $this->blank     = $blank;
    }

    public function __toString()
    {
        return $this->routeName;
    }

    /**
     * @return bool
     */
    public function isBlank(): bool
    {
        return $this->blank;
    }

    /**
     * @param bool $blank
     */
    public function setBlank(bool $blank): void
    {
        $this->blank = $blank;
    }

    public function getUrl()
    {
        return $this->routeUrl;
    }

    public function setUrl($url)
    {
        $this->routeUrl = $url;
    }

    public function getRouteName()
    {
        return $this->routeName;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getClasses()
    {
        return $this->classes;
    }

    public function getClassesHtml()
    {
        return implode(' ', $this->classes);
    }
}
