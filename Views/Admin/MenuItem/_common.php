<?php

use BasicApp\Menu\Models\MenuModel;
use BasicApp\Helpers\Url;

$this->tempData['title'] = t('admin.menu', 'Menu');

$parent = (new MenuModel)->find((int) $parentId);

if (!$parent)
{
    throw new Exception('Menu not found.');
}

$this->tempData['mainMenu']['site']['items']['menu']['active'] = true;

$this->tempData['breadcrumbs'][] = ['label' => $this->tempData['title'], 'url' => Url::createUrl('admin/menu')];

$this->tempData['breadcrumbs'][] = [
    'label' => $parent->menu_name, 
    'url' => Url::createUrl('admin/menu-item', [
        'item_menu_id' => $parent->menu_id
    ])
];