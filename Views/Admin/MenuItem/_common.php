<?php

use BasicApp\Menu\Models\MenuModel;
use BasicApp\Helpers\Url;

$this->data['title'] = t('admin.menu', 'Menu');

$parent = (new MenuModel)->find((int) $parentId);

if (!$parent)
{
	throw new Exception('Menu not found.');
}

$this->data['mainMenu']['menu']['active'] = true;

$this->data['breadcrumbs'][] = ['label' => $this->data['title'], 'url' => Url::createUrl('/admin/menu')];

$this->data['breadcrumbs'][] = [
	'label' => $parent->menu_name, 
	'url' => Url::createUrl('admin/menu-item', [
        'item_menu_id' => $parent->menu_id
    ])
];
