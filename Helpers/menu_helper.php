<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
use BasicApp\Menu\Models\MenuModel;
use BasicApp\Menu\Models\MenuItemModel;

if (!function_exists('menu_items'))
{
    function menu_items(string $menu, bool $create = false, array $params = []) : array
    {
        $return = [];

        $items = MenuModel::getMenuItems($menu, $create, $params);

        foreach($items as $item)
        {
            $row = [
                'label' => $item->item_name,
                'url' => $item->item_url
            ];

            $current_uri = uri_string();

            if ($current_uri == '/')
            {
                if ($item->item_url == '/')
                {
                    $row['active'] = true;
                }
            }
            else
            {
                if (trim($item->item_url, '/') == $current_uri)
                {
                    $row['active'] = true;
                }
            }

            $return[] = $row;
        }

        return $return;
    }
}