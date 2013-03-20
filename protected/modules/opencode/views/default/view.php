<?php
/* @var $this CdrController */
/* @var $model Cdr */
/* @var $form CActiveForm */
$this->breadcrumbs=array(
		Yii::t('opencode', 'Opencode') => array('default/index'),
		$model->cpid,
		Yii::t('opencode', 'View')
);
$types = array('' => '--- Xuất báo cáo ---',
		'Excel5'	=>	'File Excel',
		'CSV'		=>	'File CSV',
		'HTML'		=>	'File HTML',
);
$exportType = Yii::app()->request->getParam('export', '');
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
		<?php echo $form->labelEx($model,'a_number'); ?>
		<?php echo $form->textField($model,'a_number'); ?>
		<?php echo $form->error($model,'a_number'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'b_number'); ?>
		<?php echo $form->textField($model,'b_number'); ?>
		<?php echo $form->error($model,'b_number'); ?>
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
Yii::app()->format->booleanFormat = array('KHÔNG THÀNH CÔNG', 'Thành công');
$grid_config = array(
	'id'=>'cdr-view-grid',
	'dataProvider'=>$model->search(),
	'template'=>"{summary}\n{items}\n{pager}",
	'columns'=>array(
		'time:datetime',
		'a_number:ntext',
		'b_number:ntext',
		'eventid:number',
		'contentid:number',
		'status:boolean',
		'cost:number',
		'channeltype:ntext',
		'information:ntext',
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
