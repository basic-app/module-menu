<?php

use BasicApp\Helpers\Url;
use BasicApp\System\SystemEvents;
use BasicApp\Admin\AdminEvents;
use BasicApp\Menu\Controllers\Admin\Menu as MenuController;

SystemEvents::onPreSystem(function()
{
    helper(['menu']);
});

AdminEvents::onMainMenu(function($event)
{
    if (MenuController::checkAccess())
    {
        $event->items['site']['items']['menu'] = [
            'url' => Url::createUrl('admin/menu'),
            'label' => t('admin.menu', 'Menu')
        ];
    }
});