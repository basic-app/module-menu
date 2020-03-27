<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Menu;

use BasicApp\Menu\Events\MenuItemEvent;
use BasicApp\Menu\Models\MenuItem;

abstract class BaseMenuEvents extends \CodeIgniter\Events\Events
{

    const EVENT_MENU_ITEM = 'ba:menu_item';

    public static function onMenuItem($callback)
    {
        return static::on(static::EVENT_MENU_ITEM, $callback);
    }

    public static function menuItem(MenuItem $item) : array
    {
        $event = new MenuItemEvent;

        $event->item = $item;

        $event->return = [
            'label' => $item->item_name,
            'url' => $item->item_url
        ];

        $current_uri = uri_string();

        if ($current_uri == '/')
        {
            if ($item->item_url == '/')
            {
                $event->return['active'] = true;
            }
        }
        else
        {
            $item_url = trim($item->item_url, '/');

            if ($item_url == $current_uri)
            {
                $event->return['active'] = true;
            }
            elseif($item_url && preg_match('|^' . preg_quote($item_url, '|') . '.*|', $current_uri))
            {
                $event->return['active'] = true;
            }
        }

        static::trigger(static::EVENT_MENU_ITEM, $event);

        return $event->return;
    }

}