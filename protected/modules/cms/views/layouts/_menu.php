<?php
$this->mainMenu['cms'] = array(
	'label' => Yii::t('cms', 'Contents'),
	'items'=>array(
		array(
				'label' => Yii::t('cms', 'Content'),
				'url'=>array('/cms/node'),
				'visible' => Yii::app()->user->checkAccess('Cms.Node.Index')
			),
		array(
				'label' => Yii::t('cms', 'Category'),
				'url'=>array('/cms/category'),
				'visible' => Yii::app()->user->checkAccess('Cms.Category.Index')
			),
		array(
				'label' => Yii::t('cms', 'Files'),
				'url'=>array('/cms/file'),
				'visible' => Yii::app()->user->checkAccess('Cms.File.Index')
			),
		array(
				'label' => Yii::t('cms', 'Tags'),
				'url'=>array('/cms/tags'),
				'visible' => Yii::app()->user->checkAccess('Cms.Tags.Index')
			),
		array(
				'label' => Yii::t('cms', 'Comments'),
				'url'=>array('/cms/comments'),
				'visible' => Yii::app()->user->checkAccess('Cms.Comments.Index')
			),
	),
);