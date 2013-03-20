<?php


return array (
  'description'	=>	Yii::t('core', "Fields with <span class=\"required\">*</span> are required."),
  'elements' =>
  array (
    'title' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "title"),
      'hint' => Yii::t('core', "_HINT_Block.title"),
    ),
    'label' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "label"),
      'hint' => Yii::t('core', "_HINT_Block.label"),
    ),
    'description' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "description"),
      'hint' => Yii::t('core', "_HINT_Block.description"),
    ),
    'type' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "type"),
      'hint' => Yii::t('core', "_HINT_Block.type"),
    ),
    'option' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "option"),
      'hint' => Yii::t('core', "_HINT_Block.option"),
    ),
    'status' =>
    array (
      'type' => 'check',
      'value' => 1,
      'label' => Yii::t('core', "status"),
      'hint' => Yii::t('core', "_HINT_Block.status"),
    ),
    'url' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "url"),
      'hint' => Yii::t('core', "_HINT_Block.url"),
    ),
    'display' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "display"),
      'hint' => Yii::t('core', "_HINT_Block.display"),
    ),
  ),
);