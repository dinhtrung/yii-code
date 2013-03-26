<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Sentsms')	=>	array(Yii::t('app', 'index')),
);

if(empty($this->menu)) $this->renderPartial('_menu', array('model' => $model));
?>

<h1><?php echo $this->pageTitle = 'Tin nhắn đã gửi'; ?></h1>

<?php
$btn = array();
if (Yii::app()->getUser()->checkAccess('Sentsms.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('Sentsms.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Sentsms.Delete')) $btn[] = '{delete}';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sent-sms-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
					'time',
					'sender',
					'receiver',
					array('name' => 'msgdata', 'value' => 'urldecode($data->msgdata)', 'type' => 'ntext'),
					array('name' => 'campaign_id', 'value' => '$data->campaign_id', 'type' => 'ntext', 'filter' => CHtml::listData(Campaign::model()->findAll(), 'id', 'title')),
'dlr:boolean',
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
			'class'=>'EButtonColumnWithClearFilters',
						'template' => implode(' ', $btn),
		),
	),
)); ?>
