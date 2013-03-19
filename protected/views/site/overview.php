<?php
/* @var $this CdrController */
/* @var $model Cdr */
/* @var $form CActiveForm */
Yii::import('zii.widgets.grid.CGridView');
$types = array('' => '--- Xuất báo cáo ---',
		'Excel5'	=>	'File Excel',
		'CSV'		=>	'File CSV',
		'HTML'		=>	'File HTML',
);
$exportType = Yii::app()->request->getParam('export', '');
class CdrCGridView extends CGridView{
	/**
	 * Renders the table header.
	 */
	public function renderTableHeader()
	{
$header =<<<TABLEHEADER
<thead>
<tr>
	<th rowspan=2>CP/Mã CP</th>
	<th rowspan=2>Mã dịch vụ</th>
	<th colspan=4>Sản lượng</th>
	<th rowspan=2>Doanh thu</th>
</tr>
<tr>
	<th>Thu cước thành công</th>
	<th>Thu cước không thành công</th>
	<th>Không phát sinh cước</th>
	<th>Tổng sản lượng</th>
</tr>
</thead>
TABLEHEADER;
		if(!$this->hideHeader) echo $header;
	}

}
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cdr-search-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="span-8">
	<div class="row">
		<?php echo $form->labelEx($model,'time_start'); ?>
		<?php $this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
	 			'model' => $model,
	 			'attribute' => 'time_start',
				'options'	=>	array('dateFormat' => 'yy-mm-dd', 'hourFormat' => 'h:m:s'),
	  )); ?>
		<?php echo $form->error($model,'time_start'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'time_end'); ?>
		<?php $this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
	 			'model' => $model,
	 			'attribute' => 'time_end',
				'options'	=>	array('dateFormat' => 'yy-mm-dd', 'hourFormat' => 'h:m:s'),
	  )); ?>
		<?php echo $form->error($model,'time_end'); ?>
	</div>
</div>
<div class="span-8">
	<div class="row">
		<?php echo $form->labelEx($model,'b_number'); ?>
		<?php echo $form->textField($model,'b_number'); ?>
		<?php echo $form->error($model,'b_number'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'cpid'); ?>
		<?php echo $form->textField($model,'cpid'); ?>
		<?php echo $form->error($model,'cpid'); ?>
	</div>
</div>


<div class="span-7 last">
	<div class="row buttons">
		<?php echo CHtml::dropDownList('export', '', $types); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Gửi'); ?>
	</div>
</div>
<hr class="clearfix">

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
$grid_config =  array(
	'id'=>'cdr-summary-grid',
	'dataProvider'=>$model->summary(),
	'template'=>"{summary}\n{items}\n{pager}",
	'columns'=>array(
		'cpid:ntext',
		'b_number:ntext',
		'phatsinhcuoc:number',
		'khongtrucuoc:number',
		'khongphatsinhcuoc:number',
		'sanluong:number',
		'doanhthu:number',
	),
);
if ($exportType){
	$grid_config['exportType'] = $exportType;
	$grid_config['disablePaging'] = TRUE;
	// 	$grid_config['dataProvider']->setPagination(false);
	$this->widget('ext.widgets.grid.EExcelView', $grid_config);
} else {
	$grid_config['columns'][] = array(
			'class'=>'CButtonColumn',
			'template'	=>	'{view}',
			'viewButtonUrl'	=>	'Yii::app()->controller->createUrl("view",array("cpid"=>$data->cpid))',
		);
	$this->widget('CdrCGridView', $grid_config);
}

