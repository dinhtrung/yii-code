<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Sendsms')	=>	array(Yii::t('app', 'index')),
);

$this->renderPartial('_menu');
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Manage'). " ".Yii::t('app', 'Sendsms'); ?></h1>

<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Sendsms.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('Sendsms.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Sendsms.Delete')) $btn[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'send-sms-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
					'time',
					'sender',
					'receiver',
					array('name' => 'msgdata', 'value' => 'urldecode($data->msgdata)', 'type' => 'ntext'),
					array('name' => 'campaign_id', 'value' => '$data->campaign_id', 'type' => 'ntext', 'filter' => CHtml::listData(Campaign::model()->findAll(), 'id', 'title')),

		/*
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
		*/
		array(
			'class'=>'EButtonColumn',
						'template' => implode(' ', $btn),
		),
	),
)); ?>
