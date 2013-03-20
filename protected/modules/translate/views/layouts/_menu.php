<?php
$this->mainMenu['translate'] = array(
	'label' => Yii::t('translate', 'Translate'),
	'items'=>array(
		array('label' => Yii::t('translate', 'All Translation'), 'url'=>array('/translate/edit/admin'), 'visible'=>Yii::app()->user->checkAccess('Translate.Edit.Admin')),
		array('label' => Yii::t('translate', 'Missing Translation'), 'url'=>array('/translate/edit/missing'), 'visible'=>Yii::app()->user->checkAccess('Translate.Edit.Missing')),
	),
);