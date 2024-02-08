<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Menu\Database\Seeds;

use BasicApp\Menu\Models\MenuModel;
use BasicApp\Menu\Models\MenuItemModel;
use BasicApp\Helpers\Url;

class MenuSeeder extends \BasicApp\Core\Seeder
{

    public function run()
    {
        if ($this->db->table('menu')->countAllResults() != 0)
        {
            return;
        }

        $mainMenu = MenuModel::getMenu('main', true, ['menu_name' => 'Index']);

        if ($mainMenu)
        {
            MenuItemModel::getEntity(
                [
                    'item_menu_id' => $mainMenu->menu_id, 
                    'item_url' => '/'
                ], 
                true, 
                [
                    'item_name' => 'Index',
                    'item_enabled' => 1,
                    'item_sort' => 1
                ]
            );

            MenuItemModel::getEntity(
                [
                    'item_menu_id' => $mainMenu->menu_id, 
                    'item_url' => '/page/about'
                ], 
                true, 
                [
                    'item_name' => 'About',
                    'item_enabled' => 1,
                    'item_sort' => 10
                ]
            );
        }

        $socialMenu = MenuModel::getMenu('social', true, ['menu_name' => 'Social Buttons']);

        if ($socialMenu)
        {
            MenuItemModel::getEntity(
                [
                    'item_menu_id' => $socialMenu->menu_id, 
                    'item_url' => 'https://github.com/basic-app'
                ], 
                true, 
                [
                    'item_name' => 'GitHub',
                    'item_enabled' => 1,
                    'item_sort' => 10,
                    'item_uid' => 'fa-github'
                ]
            );
        }
    }

}