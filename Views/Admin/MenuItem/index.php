<?php

use BasicApp\Menu\Models\MenuItemModel;
use BasicApp\Helpers\Url;

require __DIR__ . '/_common.php';

unset($this->data['breadcrumbs'][count($this->data['breadcrumbs']) - 1]['url']);

$this->data['actionMenu'][] = [
    'url' => Url::returnUrl('admin/menu-item/create', [
        'item_menu_id' => $parentId
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
            'content' => $model->getFieldLabel('item_id')
        ],
        $model->getFieldLabel('item_created_at'),
        $model->getFieldLabel('item_url'),
        [
            'class' => $adminTheme::GRID_HEADER_LABEL,
            'content' => $model->getFieldLabel('item_name')
        ],
        [
            'class' => $adminTheme::GRID_HEADER_LARGE,
            'content' => $model->getFieldLabel('item_sort')
        ],
        ['class' => $adminTheme::GRID_HEADER_BOOLEAN, 'content' => $model->getFieldLabel('item_enabled')],
        ['class' => $adminTheme::GRID_HEADER_BUTTON],
        ['class' => $adminTheme::GRID_HEADER_BUTTON]
    ],
    'items' => function() use ($elements, $adminTheme) {
        
        foreach($elements as $data)
        {
            yield [
                $data->item_id,
                $data->item_created_at,
                $data->item_url,
                $data->item_name,
                $data->item_sort,
                [
                    'class' => $adminTheme::GRID_CELL_BOOLEAN,
                    'content' => $data->item_enabled
                ],
                [
                    'class' => $adminTheme::GRID_CELL_BUTTON_UPDATE,
                    'url' => Url::returnUrl('admin/menu-item/update', ['id' => $data->item_id])
                ],            
                [
                    'class' => $adminTheme::GRID_CELL_BUTTON_DELETE,
                    'url' => Url::returnUrl('admin/menu-item/delete', ['id' => $data->item_id])
                ]
            ];
        }
    }
]);

if ($pager)
{
    echo $pager->links('default', 'adminTheme');
}