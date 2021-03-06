<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Menu\Models;

abstract class BaseMenuModel extends \BasicApp\Core\Model
{

    protected $table = 'menu';

    protected $primaryKey = 'menu_id';

    protected $returnType = Menu::class;

    protected $fieldLabels = [
        'menu_name' => 'Name',
        'menu_uid' => 'UID',
        'menu_id' => 'ID',
        'menu_created_at' => 'Created At',
        'menu_updated_at' => 'Updated At'
    ];

    protected $langCategory = 'menu';

    public static function getMenu(string $uid, bool $create = false, array $params = [])
    {
        return static::getEntity(['menu_uid' => $uid], $create, $params);
    }

    public function beforeDelete(array $params)
    {
        foreach($params['id'] as $id)
        {
            $items = MenuItemModel::factory()
                ->select('item_id')
                ->where('item_menu_id', $id)
                ->asArray()
                ->findAll();

            foreach($items as $item)
            {
                if (!MenuItemModel::factory()->delete($item['item_id']))
                {
                    throw new Exception('Delete error.');
                }
            }
        }
    }

    public static function getMenuItems(string $uid, bool $create = false, array $params = [])
    {
        $menu = static::getMenu($uid, $create, $params);

        if (!$menu)
        {
            return [];
        }

        $menuModel = new MenuModel;

        $query = new MenuItemModel;

        $items = $query
            ->where([
                'item_menu_id' => $menu->menu_id,
                'item_enabled' => 1
            ])
            ->orderBy('item_sort ASC')
            ->join($menuModel->table, $query->table . '.item_menu_id=' . $menuModel->table . '.menu_id', 'left')
            ->findAll();

        return $items;
    }

}