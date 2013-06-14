<?php
$this->mainMenu['projectbank'] = array(
	'label' => Yii::t('projectbank', 'Project Bank'),
	'url'=>array('/projectbank/projects/index'),
	'visible' => Yii::app()->user->checkAccess('Projectbank.Projects.Index'),
	'items'=>array(
		array(
				'label' => Yii::t('projectbank', 'Projects Administration'),
				'url'=>array('/projectbank/projects/admin'),
				'visible' => Yii::app()->user->checkAccess('Projectbank.Projects.Admin')
			),
		array(
				'label' => Yii::t('projectbank', 'Create Projects'),
				'url'=>array('/projectbank/projects/create'),
				'visible' => Yii::app()->user->checkAccess('Projectbank.Projects.Create')
			),
		array(
				'label' => Yii::t('projectbank', 'Tickets'),
				'url'=>array('/projectbank/tickets/index'),
				'visible' => Yii::app()->user->checkAccess('Projectbank.Tickets.Index')
			),
		array(
				'label' => Yii::t('projectbank', 'Create Tickets'),
				'url'=>array('/projectbank/tickets/create'),
				'visible' => Yii::app()->user->checkAccess('Projectbank.Tickets.Create')
			),
		array(
				'label' => Yii::t('projectbank', 'Manage Tickets'),
				'url'=>array('/projectbank/tickets/admin'),
				'visible' => Yii::app()->user->checkAccess('Projectbank.Tickets.Admin')
			),
	),
);