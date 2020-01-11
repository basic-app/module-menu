<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Menu\Models\Admin;

abstract class BaseMenuModel extends \BasicApp\Menu\Models\MenuModel
{

    protected $returnType = Menu::class;

    protected $allowedFields = [
        'menu_name', 
        'menu_uid',
        'menu_item_icon',
        'menu_item_class',
        'menu_item_link_class'
    ];

    protected $validationRules = [
        'menu_name' => 'not_special_chars|max_length[255]|required',
        'menu_uid' => 'alpha_dash|max_length[255]|is_unique[menu.menu_uid,menu_id,{menu_id}]|required',
        'menu_item_icon' => 'not_special_chars|max_length[255]',
        'menu_item_class' => 'not_special_chars|max_length[255]',
        'menu_item_link_class' => 'not_special_chars|max_length[255]'
    ];

}