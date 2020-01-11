<?php

use BasicApp\Helpers\Url;

$this->data['title'] = t('admin.menu', 'Menu');

$this->data['mainMenu']['site']['items']['menu']['active'] = true;

$this->data['breadcrumbs'][] = ['label' => $this->data['title'], 'url' => Url::createUrl('/admin/menu')];