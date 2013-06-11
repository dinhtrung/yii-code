<?php
/* @var $this UcbController */
/* @var $model Ucb */

$this->breadcrumbs=array(
	'Ucbs'=>array('index'),
	$model->data_timestamp,
);

$this->menu=array(
	array('label'=>'List Ucb', 'url'=>array('index')),
	array('label'=>'Create Ucb', 'url'=>array('create')),
	array('label'=>'Update Ucb', 'url'=>array('update', 'id'=>$model->data_timestamp)),
	array('label'=>'Delete Ucb', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->data_timestamp),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ucb', 'url'=>array('admin')),
);
?>

<h1>View Ucb #<?php echo $model->data_timestamp; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'data_timestamp',
		'node_id',
		'leg1_cg',
		'leg1_cd',
		'leg1_starttime',
		'leg1_answertime',
		'leg1_endtime',
		'leg1_callduration',
		'leg1_status',
		'leg2_cg',
		'leg2_cd',
		'leg2_starttime',
		'leg2_answertime',
		'leg2_endtime',
		'leg2_callduration',
		'leg2_status',
		'bridge_starttime',
		'bridge_endtime',
		'bridge_callduration',
		'ivr_cd',
		'ivr_starttime',
		'ivr_answertime',
		'ivr_endtime',
		'ivr_callduration',
		'ivr_status',
		'getnotif_status',
		'notif_type',
		'notif_status',
		'call_type',
		'subscriber_type',
		'redial_type',
		'chargingprefix',
		'reverse_type',
		'diameter_status',
		'diameter_status_refund',
		'getredial_status',
		'updateredial_status',
		'cdr_inserthistory_status',
		'calling_vlr',
		'called_vlr',
	),
)); ?>
