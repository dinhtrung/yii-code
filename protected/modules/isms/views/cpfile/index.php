<?php
if (empty($this->breadcrumbs)) $this->breadcrumbs = array(
Yii::t('isms', 'Cpfile') => array('index') ,
	Yii::t('isms', 'Index') ,
);
if (empty($this->menu)) $this->menu = array(
	array(
		'label' => Yii::t('isms', 'Create') . ' CampaignFilter',
		'url' => array(
			'create'
		)
	) ,
	array(
		'label' => Yii::t('isms', 'Manage') . ' CampaignFilter',
		'url' => array(
			'admin'
		)
	) ,
);
?>

<h1>Campaign Filters</h1>

<p><?php echo Yii::t('isms', 'No data'); ?></p>
