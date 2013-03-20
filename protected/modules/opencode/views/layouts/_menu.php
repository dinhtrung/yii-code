<?php
$this->mainMenu['opencode'] = array(
	'label' => Yii::t('opencode', 'opencode'),
	'url'	=>	array('/opencode'),
	'visible'	=>	Yii::app()->user->checkAccess('Opencode.Default.Index'),
);