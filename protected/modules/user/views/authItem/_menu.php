<?php
$this->menu['roles'] = array(
		'label'	=>	Yii::t('rights', 'Create Role'),
		'visible'	=>	Yii::app()->user->checkAccess('Rights.AuthItem.Create'),
		'url'	=>	array('/rights/authitem/create', 'type' => 2),
);
