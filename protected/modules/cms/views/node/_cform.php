<?php


return array (
  'elements' =>
  array (
    'title' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "title"),
      'hint' => Yii::t('core', "_HINT_Node.title"),
    ),
    'body' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "body"),
      'hint' => Yii::t('core', "_HINT_Node.body"),
    ),
    'cid' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "cid"),
      'hint' => Yii::t('core', "_HINT_Node.cid"),
    ),
    'tags' =>
    array (
      'type' => 'text',
      'size' => 20,
      'label' => Yii::t('core', "tags"),
      'hint' => Yii::t('core', "_HINT_Node.tags"),
    ),
    'status' =>
    array (
      'type' => 'check',
      'value' => 1,
      'label' => Yii::t('core', "status"),
      'hint' => Yii::t('core', "_HINT_Node.status"),
    ),
  ),
);