<?php


return array (
  'description'	=>	Yii::t('app', "Fields with <span class=\"required\">*</span> are required."),
  'elements' =>
  array (
    'title' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('block', "title"),
      'hint' => Yii::t('block', "_HINT_Block.title"),
    ),
    'label' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('block', "label"),
      'hint' => Yii::t('block', "_HINT_Block.label"),
    ),
    'description' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('block', "description"),
      'hint' => Yii::t('block', "_HINT_Block.description"),
    ),
    'type' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('block', "type"),
      'hint' => Yii::t('block', "_HINT_Block.type"),
    ),
    'option' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('block', "option"),
      'hint' => Yii::t('block', "_HINT_Block.option"),
    ),
    'status' =>
    array (
      'type' => 'check',
      'value' => 1,
      'label' => Yii::t('block', "status"),
      'hint' => Yii::t('block', "_HINT_Block.status"),
    ),
    'url' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('block', "url"),
      'hint' => Yii::t('block', "_HINT_Block.url"),
    ),
    'display' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('block', "display"),
      'hint' => Yii::t('block', "_HINT_Block.display"),
    ),
  ),
);