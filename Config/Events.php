<?php

use BasicApp\Helpers\Url;
use BasicApp\System\SystemEvents;
use BasicApp\Admin\AdminEvents;
use BasicApp\Menu\Controllers\Admin\Menu as MenuController;
use BasicApp\Menu\Database\Seeds\MenuResetSeeder;
use BasicApp\Menu\Database\Seeds\MenuSeeder;
use Config\Database;
use CodeIgniter\Events\Events;
use BasicApp\AdminMenu\AdminMenuEvents;

Events::on('pre_system', function() 
{
    helper(['menu']);
});

if (class_exists(AdminMenuEvents::class))
{
    AdminMenuEvents::onMainMenu(function($event)
    {
        $event->items['site']['items']['menu'] = [
            'url' => Url::createUrl('admin/menu'),
            'label' => t('admin.menu', 'Menu')
        ];
    });
}