<?php


return array (
  'elements' =>
  array (
    'title' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('cms', "title"),
      'hint' => Yii::t('cms', "_HINT_Node.title"),
    ),
    'body' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('cms', "body"),
      'hint' => Yii::t('cms', "_HINT_Node.body"),
    ),
    'cid' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('cms', "cid"),
      'hint' => Yii::t('cms', "_HINT_Node.cid"),
    ),
    'tags' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('cms', "tags"),
      'hint' => Yii::t('cms', "_HINT_Node.tags"),
    ),
    'status' =>
    array (
      'type' => 'check',
      'value' => 1,
      'label' => Yii::t('cms', "status"),
      'hint' => Yii::t('cms', "_HINT_Node.status"),
    ),
  ),
);