<?php
$this->mainMenu['querybuilder'] = array(
	'label' => Yii::t('querybuilder', 'Query Builder'),
	'url'	=>	array('/querybuilder'),
	'visible'	=>	Yii::app()->user->checkAccess('Querybuilder.Default.Index'),
);