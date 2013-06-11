<?php
/* @var $this UcbController */
/* @var $model Ucb */
$types = array('' => '--- Xuất báo cáo ---',
		'Excel5'	=>	'File Excel',
		'CSV'		=>	'File CSV',
		'HTML'		=>	'File HTML',
);
$exportType = Yii::app()->request->getParam('export', '');
$this->breadcrumbs=array(
	'Ucbs'=>array('index'),
	'Manage',
);

?>

<h1><?php echo Yii::t('app', 'UCB Reports: %suffix', array('%suffix' => $model->tableName())); ?></h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ucb-search-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="span-8">
	<div class="row">
		<?php echo $form->labelEx($model,'tableSuffix'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	 			'name' 	=> 'suffix',
				'value'	=>	$model->tableSuffix,
				'options'	=>	array('dateFormat' => 'yymm'),
	  )); ?>
	</div>
</div>
<div class="span-5">
	<div class="row buttons">
		<?php echo CHtml::dropDownList('export', '', $types); ?>
	</div>
</div>
<div class="span-2 last">
	<div class="row buttons">
		<?php echo CHtml::submitButton('Gửi'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>
<hr class="clearfix">


<?php 
Yii::app()->format->numberFormat = array('thousandSeparator' => ' ', 'decimals' => 0, 'decimalSeparator' => '');
$grid_config =  array(
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
);
if ($exportType){
	$grid_config['exportType'] = $exportType;
	$grid_config['disablePaging'] = TRUE;
	// 	$grid_config['dataProvider']->setPagination(false);
	$this->widget('ext.widgets.grid.EExcelView', $grid_config);
} else {
	$this->widget('zii.widgets.grid.CGridView', $grid_config);
}
