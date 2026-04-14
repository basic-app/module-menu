<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
use BasicApp\Menu\MenuEvents;
use BasicApp\Menu\Models\MenuModel;

if (!function_exists('menu'))
{
    function menu(string $menu, bool $create = false, array $params = []) : array
    {
        $return = [];

        foreach(MenuModel::getMenuItems($menu, $create, $params) as $menuItem)
        {
            $data = $menuItem->toArray();

            $data['item_url'] = $menuItem->getUrl(); 

            if ($menuItem->item_uid)
            {
                $return[$menuItem->item_uid] = $data;
            }
            else
            {
                $return[] = $data;
            }
        }

        return $return;
    }
}