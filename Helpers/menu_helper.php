<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
use BasicApp\Menu\MenuEvents;
use BasicApp\Menu\Models\MenuModel;

if (!function_exists('menu_items'))
{
    function menu_items(string $menu, bool $create = false, array $params = []) : array
    {
        $return = [];

        foreach(MenuModel::getMenuItems($menu, $create, $params) as $menuItem)
        {
            if ($menuItem->item_uid)
            {
                $return[$menuItem->item_uid] = MenuEvents::menuItem($menuItem);
            }
            else
            {
                $return[] = MenuEvents::menuItem($menuItem);
            }
        }

        return $return;
    }
}