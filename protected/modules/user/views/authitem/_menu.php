<?php
$this->menu['permissions'] = array(
		'label' => Yii::t('user', 'Permissions'),
		'url'=>array('/user/authitem/permissions'),
		'visible' => Yii::app()->user->checkAccess('User.Authitem.Permissions')
);
$this->menu['roles'] = array(
		'label' => Yii::t('user', 'Roles'),
		'url'=>array('/user/authitem/roles'),
		'visible' => Yii::app()->user->checkAccess('User.Authitem.Create.Roles'),
		'items'	=>	array(
			array(
				'label' => Yii::t('user', 'Create Roles'),
				'url'=>array('/user/authitem/create', 'type' => CAuthItem::TYPE_ROLE),
				'visible' => Yii::app()->user->checkAccess('User.Authitem.Create.Roles')
			)
		),
);
$this->menu['tasks'] = array(
		'label' => Yii::t('user', 'Tasks'),
		'url'=>array('/user/authitem/tasks'),
		'visible' => Yii::app()->user->checkAccess('User.Authitem.Tasks'),
		'items'	=>	array(
				array(
						'label' => Yii::t('user', 'Create Tasks'),
						'url'=>array('/user/authitem/create', 'type' => CAuthItem::TYPE_TASK),
						'visible' => Yii::app()->user->checkAccess('User.Authitem.Create.Tasks')
				)
		),
);
$this->menu['operations'] = array(
		'label' => Yii::t('user', 'Operations'),
		'url'=>array('/user/authitem/operations'),
		'visible' => Yii::app()->user->checkAccess('User.Authitem.Operations'),
		'items'	=>	array(
				array(
						'label' => Yii::t('user', 'Create Operations'),
						'url'=>array('/user/authitem/create', 'type' => CAuthItem::TYPE_OPERATION),
						'visible' => Yii::app()->user->checkAccess('User.Authitem.Create.Operations')
				)
		),
);