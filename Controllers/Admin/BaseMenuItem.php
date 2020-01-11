<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Menu\Controllers\Admin;

use BasicApp\Menu\Models\Admin\MenuItemModel;

abstract class BaseMenuItem extends \BasicApp\Admin\AdminCrudController
{

    protected $modelClass = MenuItemModel::class;

    protected $viewPath = 'BasicApp\Menu\Views\Admin\MenuItem';

    protected $returnUrl = null;

    protected $parentKey = 'item_menu_id';

    protected $orderBy = 'item_sort';

    protected $perPage = null;

}