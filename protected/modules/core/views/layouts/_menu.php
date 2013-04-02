<?php
if (Yii::app()->user->checkAccess('Core.*.*'))
$this->mainMenu['core'] = array(
	'label' => Yii::t('core', 'Core'),
	'url'=>array('/core/block'),
	'visible' => Yii::app()->user->checkAccess('Core.Block.Index'),
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
				'label' => Yii::t('core', 'Website'),
				'url'=>array('/core/website'),
				'visible' => Yii::app()->user->checkAccess('Core.Website.Index')
			),
	),
);