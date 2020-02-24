<?php

$adminTheme = service('adminTheme');

$form = $adminTheme->createForm($model, $errors);

echo $form->openMultipart();

echo $form->inputGroup($data, 'item_name');

echo $form->inputGroup($data, 'item_url');

echo $form->inputGroup($data, 'item_uid');

echo $form->inputGroup($data, 'item_sort');

echo $form->checkboxGroup($data, 'item_enabled');

echo $form->renderErrors();

echo $form->beginButtons();

$label = $data->getPrimaryKey() ? t('admin', 'Update') : t('admin', 'Insert');

echo $form->submitButton($label);

echo $form->endButtons();

echo $form->close();