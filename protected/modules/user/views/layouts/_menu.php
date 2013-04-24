<?php
$this->mainMenu['rights'] = array(
	'label' => Yii::t('rights', 'Rights'),
	'items'=>array(
		array(
				'label' => Yii::t('rights', 'Assignment'),
				'url'=>array('/rights/assignment'),
				'visible' => Yii::app()->user->checkAccess('Rights.Assignment.View')
			),
		array(
				'label' => Yii::t('rights', 'Permissions'),
				'url'=>array('/rights/authItem/permissions'),
				'visible' => Yii::app()->user->checkAccess('Rights.AuthItem.Permissions')
			),
		array(
				'label' => Yii::t('rights', 'Roles'),
				'url'=>array('/rights/authItem/roles'),
				'visible' => Yii::app()->user->checkAccess('Rights.AuthItem.Roles')
			),
		array(
				'label' => Yii::t('rights', 'Tasks'),
				'url'=>array('/rights/authItem/tasks'),
				'visible' => Yii::app()->user->checkAccess('Rights.AuthItem.Tasks')
			),
		array(
				'label' => Yii::t('rights', 'Operations'),
				'url'=>array('/rights/authItem/operations'),
				'visible' => Yii::app()->user->checkAccess('Rights.AuthItem.Operations')
			),
	),
);