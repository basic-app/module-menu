<?php

namespace BasicApp\Menu\Events;

class MenuItemEvent extends \BasicApp\Core\Event
{

    public $item;

    public $return = [];

}