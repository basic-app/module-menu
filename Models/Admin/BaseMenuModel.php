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
        'menu_uid'
    ];

    protected $validationRules = [
        'menu_name' => 'not_special_chars|max_length[255]|required',
        'menu_uid' => 'alpha_dash|max_length[255]|is_unique[menu.menu_uid,menu_id,{menu_id}]|required'
    ];

    public function __construct()
    {
        parent::__construct();

        $this->validationRules['menu_uid'] = str_replace('menu.', $this->table . '.', $this->validationRules['menu_uid']);
    }

}