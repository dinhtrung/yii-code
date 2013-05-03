<?php
$this->mainMenu['projects'] = array(
	'label' => Yii::t('projects', 'Projects'),
	'url'=>array('/projects/default/index'),
	'visible' => Yii::app()->user->checkAccess('Projects.Default.Index'),
	'items'=>array(
		array(
				'label' => Yii::t('projects', 'Projects'),
				'url'=>array('/projects/projects/index'),
				'visible' => Yii::app()->user->checkAccess('Projects.Projects.Index')
			),
		array(
				'label' => Yii::t('projects', 'Departments'),
				'url'=>array('/projects/departments/index'),
				'visible' => Yii::app()->user->checkAccess('Projects.Departments.Index')
			),
		array(
				'label' => Yii::t('projects', 'Contacts'),
				'url'=>array('/projects/contacts/index'),
				'visible' => Yii::app()->user->checkAccess('Projects.Contacts.Index')
			),
		array(
				'label' => Yii::t('projects', 'Events'),
				'url'=>array('/projects/events/index'),
				'visible' => Yii::app()->user->checkAccess('Projects.Events.Index')
			),
		array(
				'label' => Yii::t('projects', 'Forums'),
				'url'=>array('/projects/forums/index'),
				'visible' => Yii::app()->user->checkAccess('Projects.Forums.Index')
			),
		array(
				'label' => Yii::t('projects', 'Notes'),
				'url'=>array('/projects/notes/index'),
				'visible' => Yii::app()->user->checkAccess('Projects.Notes.Index')
			),
		array(
				'label' => Yii::t('projects', 'Task Log'),
				'url'=>array('/projects/taskLog/index'),
				'visible' => Yii::app()->user->checkAccess('Projects.TaskLog.Index')
			),
		array(
				'label' => Yii::t('projects', 'Tickets'),
				'url'=>array('/projects/tickets/index'),
				'visible' => Yii::app()->user->checkAccess('Projects.Tickets.Index')
			),
	),
);