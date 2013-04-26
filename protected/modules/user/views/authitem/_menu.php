<?php
$this->menu['permissions'] = array(
		'label' => Yii::t('user', 'Permissions'),
		'url'=>array('/user/authitem/permissions'),
		'visible' => Yii::app()->user->checkAccess('User.Authitem.Permissions')
);
$this->menu['roles'] = array(
		'label' => Yii::t('user', 'Roles'),
		'url'=>array('/user/authitem/roles'),
		'visible' => Yii::app()->user->checkAccess('User.Authitem.Roles')
);
$this->menu['tasks'] = array(
		'label' => Yii::t('user', 'Tasks'),
		'url'=>array('/user/authitem/tasks'),
		'visible' => Yii::app()->user->checkAccess('User.Authitem.Tasks')
);
$this->menu['operations'] = array(
		'label' => Yii::t('user', 'Operations'),
		'url'=>array('/user/authitem/operations'),
		'visible' => Yii::app()->user->checkAccess('User.Authitem.Operations')
);