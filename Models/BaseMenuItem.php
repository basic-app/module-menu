<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Menu\Models;

abstract class BaseMenuItem extends \BasicApp\Core\Entity
{
    protected $modelClass = MenuItemModel::class;

    public function __construct()
    {
        parent::__construct();

        $this->item_enabled = true;
    }

    public function getUrl() : ?string
    {
        if ($this->item_url)
        {
            if (mb_substr($this->item_url, 0, 1) == '/')
            {
                return site_url($this->item_url);
            }

            return $this->item_url;
        }

        return null;
    }
}