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

<h1><?php echo Yii::t('app', 'UCB Reports'); ?></h1>

<p class="desc">Nhập thời gian vào ô lọc dữ liệu để xem theo ngày tháng. Định dạng thời gian là <em>YYYY-MM-DD</em>. </p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ucb-search-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row column">
		<?php echo CHtml::dropDownList('export', '', $types); ?>
		<?php echo CHtml::submitButton('Gửi'); ?>
	</div>
<?php $this->endWidget(); ?>


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
