<?php
$this->mainMenu['ussdbr'] = array(
	'label' => Yii::t('ussdbr', 'Ussdbr'),
	'url'=>array('/ussdbr/default/index'),
	'visible' => Yii::app()->user->checkAccess('Ussdbr.Default.Index'),
	'items'=>array(
		array(
				'label' => Yii::t('ussdbr', 'USSD Browser CDR'),
				'url'=>array('/ussdbr/cdr/index'),
				'visible' => Yii::app()->user->checkAccess('Ussdbr.Cdr.Index')
			),
		array(
				'label' => Yii::t('ussdbr', 'UCB - SCB CDR'),
				'url'=>array('/ussdbr/ucb/index'),
				'visible' => Yii::app()->user->checkAccess('Ussdbr.Ucb.Index')
			),
	),
);