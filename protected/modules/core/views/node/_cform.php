<?php


return array (
  'elements' =>
  array (
    'title' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('node', "title"),
      'hint' => Yii::t('node', "_HINT_Node.title"),
    ),
    'body' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('node', "body"),
      'hint' => Yii::t('node', "_HINT_Node.body"),
    ),
    'cid' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('node', "cid"),
      'hint' => Yii::t('node', "_HINT_Node.cid"),
    ),
    'tags' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('node', "tags"),
      'hint' => Yii::t('node', "_HINT_Node.tags"),
    ),
    'status' =>
    array (
      'type' => 'check',
      'value' => 1,
      'label' => Yii::t('node', "status"),
      'hint' => Yii::t('node', "_HINT_Node.status"),
    ),
  ),
);