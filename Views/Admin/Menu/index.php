<?php

require __DIR__ . '/_common.php';

use BasicApp\Site\Models\MenuModel;
use BasicApp\Helpers\Url;

unset($this->data['breadcrumbs'][count($this->data['breadcrumbs']) - 1]['url']);

$this->data['actionMenu'][] = [
    'url' => Url::returnUrl('admin/menu/create', [
        'link_user_id' => $parentId
    ]),
    'label' => t('admin', 'Create'), 
    'icon' => 'fa fa-plus',
    'linkAttributes' => [
        'class' => 'btn btn-success'
    ]   
];

$adminTheme = service('adminTheme');

echo $adminTheme->table([
    'labels' => [
        $model->getFieldLabel('menu_id'),
        $model->getFieldLabel('menu_created_at'),
        $model->getFieldLabel('menu_uid'),
        $model->getFieldLabel('menu_name'),
        '',
        '',
        ''
    ],
    'elements' => $elements,
    'columns' => function($model) {
        return [
            $this->createColumn(['field' => 'menu_id'])->number()->displaySmall(),
            $this->createColumn(['field' => 'menu_created_at'])->displayMedium(),
            $this->createColumn(['field' => 'menu_uid'])->success(),
            $this->createColumn(['field' => 'menu_name'])->displaySmall(),
            $this->createLinkColumn([
                'label' => t('admin.menu', 'Items'), 
                'url' => Url::createUrl('admin/menu-item', ['item_menu_id' => $model->getPrimaryKey()])
            ]),
            $this->createUpdateLinkColumn(['action' => 'admin/menu/update']),
            $this->createDeleteLinkColumn(['action' => 'admin/menu/delete'])
        ];
    }
]);

if ($pager)
{
    echo $pager->links('default', 'adminTheme');
}