<?php

use BasicApp\Helpers\Url;

$this->tempData['title'] = t('admin.menu', 'Menu');

$this->tempData['mainMenu']['site']['items']['menu']['active'] = true;

$this->tempData['breadcrumbs'][] = ['label' => $this->tempData['title'], 'url' => Url::createUrl('/admin/menu')];