<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Send Sms') =>	array('index'),$model->receiver	=>	array_merge(array('view'),$model->getPrimaryKey()),

);

$this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'View')." ".Yii::t('app', 'Sendsms') . " " . $model->receiver; ?></h1>

<?php $this->beginClip('basic'); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'momt',
		'sender',
		'receiver',
		'udhdata',
		'msgdata',
		'time',
		'smsc_id',
		'service',
		'account',
		'id',
		'sms_type',
		'mclass',
		'mwi',
		'coding',
		'compress',
		'validity',
		'deferred',
		'dlr_mask',
		'dlr_url',
		'pid',
		'alt_dcs',
		'rpi',
		'charset',
		'boxc_id',
		'binfo',
		'campaign_id',
		'bearerbox_id',
	),
)); ?>

<?php $this->endClip(); ?>


<?php  $this->widget('CTabView', array(
			'tabs' => array(
				'basic'=>array(
			          'title'	=>	Yii::t('app', 'Basic'),
			          'content'	=> $this->clips['basic'],
			    ),
			    			)
		)
	);
?>

