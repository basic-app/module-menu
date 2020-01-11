<?php

$adminTheme = service('adminTheme');

$form = $adminTheme->createForm($model, $errors);

echo $form->open();

echo $form->inputGroup($data, 'menu_name');

echo $form->inputGroup($data, 'menu_uid');

echo $form->inputGroup($data, 'menu_item_icon');

echo $form->inputGroup($data, 'menu_item_class');

echo $form->inputGroup($data, 'menu_item_link_class');

echo $form->renderErrors();

echo $form->beginButtons();

$label = $data->getPrimaryKey() ? t('admin', 'Update') : t('admin', 'Insert');

echo $form->submitButton($label);

echo $form->endButtons();

echo $form->close();