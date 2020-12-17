<?php

namespace App\Widgets\Menu;

use App\Widgets\Contract\ContractWidget;

class MenuWidget implements
    ContractWidget,
    MenuWidgetInterface
{
    private $menus = [];

    private $params;

    /** @var bool|MenuInterface */
    private $activeMenu = false;

    public function setParams($params = [])
    {
        $this->params = $params;
    }

    public function createMenu(MenuInterface $menu): ?self
    {
        if (!array_key_exists($menu->getSlug(), $this->menus)) {
            array_push($this->menus, $menu);

            $this->activeMenu = $menu;

            return $this;
        }

        throw new MenuSlagExistException();
    }

    public function endMenu(): ?self
    {
        $this->activeMenu = false;

        return $this;
    }

    public function addItem(MenuItem $item): ?self
    {
        if (!$this->activeMenu) throw new MenuNotStartedException();

        $this->activeMenu->addItem($item);

        return $this;
    }

    public function execute()
    {
        if (!isset($this->params['menu_name']))
            throw new MenuSlugNotExistException();

        foreach ($this->menus as $menu) {
            /** @var $menu Menu */
            if ($menu->getSlug() == $this->params['menu_name']) {

                return view($menu->getTemplatePath(), [
                    'menu'   => $menu,
                    'params' => $this->params,
                ]);
            }
        }

        throw new MenuSlugNotExistException();
    }
}
