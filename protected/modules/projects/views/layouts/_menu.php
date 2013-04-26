<?php
$this->mainMenu['projects'] = array(
	'label' => Yii::t('projects', 'Projects'),
	'url'=>array('/projects/default/index'),
	'visible' => Yii::app()->user->checkAccess('ProjectsModule.Default.Index'),
	'items'=>array(
		array(
				'label' => Yii::t('projects', 'Controller.Action'),
				'url'=>array('/projects/controller/action'),
				'visible' => Yii::app()->user->checkAccess('ProjectsModule.Controller.Action')
			),
	),
);