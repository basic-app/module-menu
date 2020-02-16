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

echo $adminTheme->grid([
    'headers' => [
        [
            'class' => $adminTheme::GRID_HEADER_PRIMARY_KEY,
            'content' => $model->getFieldLabel('menu_id'),
        ],
        $model->getFieldLabel('menu_created_at'),
        [
            'class' => $adminTheme::GRID_HEADER_LABEL,
            'content' => $model->getFieldLabel('menu_uid')
        ],
        $model->getFieldLabel('menu_name'),
        ['class' => $adminTheme::GRID_HEADER_LINK],
        ['class' => $adminTheme::GRID_HEADER_BUTTON],
        ['class' => $adminTheme::GRID_HEADER_BUTTON]
    ],
    'items' => function() use ($elements, $adminTheme) {

        foreach($elements as $data)
        {
            yield [
                $data->menu_id,
                $data->menu_created_at,
                $data->menu_uid,
                $data->menu_name,
                [
                    'class' => $adminTheme::GRID_CELL_LINK,
                    'label' => t('admin.menu', 'Items'),
                    'url' => Url::createUrl('admin/menu-item', ['item_menu_id' => $data->getPrimaryKey()])
                ],
                [
                    'class' => $adminTheme::GRID_CELL_BUTTON_UPDATE,
                    'url' => Url::returnUrl('admin/menu/update', ['id' => $data->menu_id])
                ],
                [
                    'class' => $adminTheme::GRID_CELL_BUTTON_DELETE,
                    'url' => Url::returnUrl('admin/menu/delete', ['id' => $data->menu_id])
                ]
            ];
        }
    }
]);

if ($pager)
{
    echo $pager->links('default', 'adminTheme');
}