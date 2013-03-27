<?php
$this->mainMenu['core'] = array(
	'label' => Yii::t('core', 'Core'),
	'items'=>array(
		array(
				'label' => Yii::t('core', 'Block'),
				'url'=>array('/core/block'),
				'visible' => Yii::app()->user->checkAccess('Core.Block.Index')
			),
		array(
				'label' => Yii::t('core', 'Block Type'),
				'url'=>array('/core/blocktype'),
				'visible' => Yii::app()->user->checkAccess('Core.Blocktype.Index')
			),
		array(
				'label' => Yii::t('core', 'Category'),
				'url'=>array('/core/category'),
				'visible' => Yii::app()->user->checkAccess('Core.Category.Index')
			),
		array(
				'label' => Yii::t('core', 'File'),
				'url'=>array('/core/file'),
				'visible' => Yii::app()->user->checkAccess('Core.File.Index')
			),
		array(
				'label' => Yii::t('core', 'Webmenu'),
				'url'=>array('/core/webmenu'),
				'visible' => Yii::app()->user->checkAccess('Core.Webmenu.Index')
			),
		array(
				'label' => Yii::t('core', 'Website'),
				'url'=>array('/core/website'),
				'visible' => Yii::app()->user->checkAccess('Core.Website.Index')
			),
	),
);