<?php

use BasicApp\Site\SiteEvents;
use BasicApp\Helpers\Url;
use BasicApp\System\SystemEvents;
use BasicApp\Admin\AdminEvents;
use BasicApp\Menu\Controllers\Admin\Menu as MenuController;
use BasicApp\System\Events\SystemResetEvent;
use BasicApp\System\Events\SystemSeedEvent;
use BasicApp\Menu\Database\Seeds\MenuResetSeeder;
use BasicApp\Menu\Database\Seeds\MenuSeeder;
use Config\Database;
use CodeIgniter\Events\Events;

Events::on('pre_system', function() 
{
    helper(['menu']);
});

if (class_exists(AdminEvents::class))
{
    AdminEvents::onMainMenu(function($event)
    {
        $event->items['site']['items']['menu'] = [
            'url' => Url::createUrl('admin/menu'),
            'label' => t('admin.menu', 'Menu')
        ];
    });
}

if (class_exists(SystemEvents::class))
{
    SystemEvents::onReset(function(SystemResetEvent $event)
    {
        $seeder = Database::seeder();

        $seeder->call(MenuResetSeeder::class);
    });
}

if (class_exists(SystemEvents::class))
{
    SystemEvents::onSeed(function(SystemSeedEvent $event)
    {
        $seeder = Database::seeder();

        $seeder->call(MenuSeeder::class);
    });
}

if (class_exists(SiteEvents::class))
{
    SiteEvents::onMainLayout(function($event) 
    {
        $event->params['mainMenu'] = array_merge_recursive(menu_items('main', false), $event->params['mainMenu'] ?? []);

        $items = menu_items('social', false);

        foreach($items as $key => $item)
        {
            if (!is_numeric($key))
            {
                $items[$key]['icon'] = $key;
            }
        }

        $event->params['socialMenu'] = $items; 
    });
}