<?php
/* @var $this UcbController */
/* @var $model Ucb */

$this->breadcrumbs=array(
	'Ucbs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Ucb', 'url'=>array('index')),
	array('label'=>'Create Ucb', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ucb-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'UCB Reports: %suffix', array('%suffix' => $model->tableName())); ?></h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
Yii::app()->format->numberFormat = array('thousandSeparator' => '&nbsp;', 'decimals' => 0, 'decimalSeparator' => '');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ucb-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'data_timestamp',
		'a:number',
		'b:number',
		'bridge_callduration',
		'bridge_endtime',		
		array('name' => 'status', 'value' => '$data->status', 'type' => 'html', 'filter' => array()),
		/*
		
		'leg1_callduration',

		'leg2_cg',
		'leg2_starttime',
		'leg2_answertime',
		'leg2_endtime',
		'leg2_callduration',
		'ivr_starttime',
		'ivr_answertime',
		'ivr_endtime',
		'getnotif_status',
		'subscriber_type',
		'redial_type',
		'chargingprefix',
		'reverse_type',
		'diameter_status_refund',
		'getredial_status',
		'updateredial_status',
		'cdr_inserthistory_status',
		*/
	),
)); ?>
