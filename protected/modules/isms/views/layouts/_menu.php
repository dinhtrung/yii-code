<?php
$tmp = array('Blacklist', 'Whitelist', 'Template', 'Worktime');
$this->mainMenu['campaign'] = array(
		'label' => Yii::t('isms', 'Campaigns'),
		'items'=>array(
				array('label' => Yii::t('isms', 'Manage'), 'url'=>array('/isms/campaign'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Campaign.Index')),
				array('label' => Yii::t('isms', 'Organization'), 'url'=>array('/isms/organization'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Organization.Index')),
				array('label' => Yii::t('isms', 'SMS Template'), 'url'=>array('/isms/template'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Template.Index')),
				array('label' => Yii::t('isms', 'Email Connections'), 'url'=>array('/isms/emailsetting'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Emailsetting.Index')),
				array('label' => Yii::t('isms', 'FTP Connections'), 'url'=>array('/isms/ftpsetting'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Ftpsetting.Index')),
				array('label' => Yii::t('isms', 'Datafile'), 'url'=>array('/isms/datafile'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Datafile.Index')),
				array('label' => Yii::t('isms', 'Worktime'), 'url'=>array('/isms/worktime'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Worktime.Index')),
				array('label' => Yii::t('isms', 'Smsorder'), 'url'=>array('/isms/smsorder'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Smsorder.Index')),
				array('label' => Yii::t('isms', 'Dailyreport'), 'url'=>array('/isms/dailyreport'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Dailyreport.Index')),
				array('label' => Yii::t('isms', 'Sendsms'), 'url'=>array('/isms/sendsms'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Sendsms.*')),
				array('label' => Yii::t('isms', 'Sentsms'), 'url'=>array('/isms/sentsms'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Sentsms.*')),
		),
);
$this->mainMenu['filter'] = array(
		'label'	=>	Yii::t('isms', 'Filter'),
		'items'	=>	array(
				array('label' => Yii::t('isms', 'Manage'), 'url'=>array('/isms/filter'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Filter.Index')),
				array('label' => Yii::t('isms', 'Blacklist'), 'url'=>array('/isms/blacklist'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Blacklist.Index')),
				array('label' => Yii::t('isms', 'Whitelist'), 'url'=>array('/isms/whitelist'), 'visible'=>Yii::app()->getUser()->checkAccess('Isms.Whitelist.Index')),
		),
);
