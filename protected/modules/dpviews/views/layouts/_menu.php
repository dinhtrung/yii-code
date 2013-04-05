<?php
$this->mainMenu['dpviews'] = array(
	'label' => Yii::t('dpviews', 'DpviewsModule'),
	'url'=>array('/dpviews/default/index'),
	'visible' => Yii::app()->user->checkAccess('DpviewsModule.Default.Index'),
	'items'=>array(
		array(
				'label' => Yii::t('?php echo $this->moduleID; ?>', 'Controller.Action'),
				'url'=>array('/dpviews/controller/action'),
				'visible' => Yii::app()->user->checkAccess('DpviewsModule.Controller.Action')
			),
	),
);