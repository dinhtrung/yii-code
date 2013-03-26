<?php
$this->breadcrumbs=array(
	'Dailyreports'=>array('index'),
	$model->id_dailyreport,
);

$this->menu=array(
	array('label'=>'List Dailyreport', 'url'=>array('index')),
	array('label'=>'Create Dailyreport', 'url'=>array('create')),
	array('label'=>'Update Dailyreport', 'url'=>array('update', 'id'=>$model->id_dailyreport)),
	array('label'=>'Delete Dailyreport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_dailyreport),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Dailyreport', 'url'=>array('admin')),
);
?>

<h1>View Dailyreport #<?php echo $model->id_dailyreport; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_dailyreport',
		'created_date',
		'sms_sent',
		'block_sent',
		'sms_delivered',
		'block_delivered',
		'campaign_id',
	),
)); ?>
