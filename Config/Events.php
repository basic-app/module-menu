<?php

use BasicApp\Helpers\Url;
use BasicApp\System\SystemEvents;
use BasicApp\Admin\AdminEvents;
use BasicApp\Menu\Controllers\Admin\Menu as MenuController;
use BasicApp\System\Events\SystemResetEvent;
use BasicApp\System\Events\SystemSeedEvent;
use BasicApp\Menu\Database\Seeds\MenuResetSeeder;
use BasicApp\Menu\Database\Seeds\MenuSeeder;
use Config\Database;

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

SystemEvents::onReset(function(SystemResetEvent $event)
{
    $seeder = Database::seeder();

    $seeder->call(MenuResetSeeder::class);
});

SystemEvents::onSeed(function(SystemSeedEvent $event)
{
    $seeder = Database::seeder();

    $seeder->call(MenuSeeder::class);
});