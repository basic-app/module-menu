<?php

$routes->add('admin/menu', '\BasicApp\Menu\Controllers\Admin\Menu::index');
$routes->add('{locale}/admin/menu', '\BasicApp\Menu\Controllers\Admin\Menu::index');

$routes->add('admin/menu/(:segment)', '\BasicApp\Menu\Controllers\Admin\Menu::$1');
$routes->add('{locale}/admin/menu/(:segment)', '\BasicApp\Menu\Controllers\Admin\Menu::$1');

$routes->add('admin/menu-item', '\BasicApp\Menu\Controllers\Admin\MenuItem::index');
$routes->add('{locale}/admin/menu-item', '\BasicApp\Menu\Controllers\Admin\MenuItem::index');

$routes->add('admin/menu-item/(:segment)', '\BasicApp\Menu\Controllers\Admin\MenuItem::$1');
$routes->add('{locale}/admin/menu-item/(:segment)', '\BasicApp\Menu\Controllers\Admin\MenuItem::$1');