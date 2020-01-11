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
		'menu_updated_at' => 'Updated At',
        'menu_item_icon' => 'Default Item Icon',
        'menu_item_class' => 'Default Item Container Class',
        'menu_item_link_class' => 'Default Item Link Class'
	];

    protected $langCategory = 'menu';

    public static function getMenu(string $uid, bool $create = false, array $params = [])
    {
        return static::getEntity(['menu_uid' => $uid], $create, $params);
    }

    public static function getMenuItems(string $uid, bool $create = false, array $params = [])
    {
        $menu = static::getMenu($uid, $create, $params);

        if (!$menu)
        {
            return [];
        }

        $query = new MenuItemModel;

        $items = $query
            ->where([
                'item_menu_id' => $menu->menu_id,
                'item_enabled' => 1
            ])
            ->orderBy('item_sort ASC')
            ->join('menu', 'menu_item.item_menu_id=menu.menu_id', 'left')
            ->findAll();

        return $items;
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

}