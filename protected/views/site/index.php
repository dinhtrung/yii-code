<?php
/* @var $this CdrController */
/* @var $model Cdr */
/* @var $form CActiveForm */
Yii::import('zii.widgets.grid.CGridView');
class CdrCGridViews extends CGridView{
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

<div class="form-inline">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cdr-search-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'time_start'); ?>
		<?php $this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
	 			'model' => $model,
	 			'attribute' => 'time_start',
				'options'	=>	array('dateFormat' => 'yy-mm-dd', 'hourFormat' => 'h:m:s', 'language' => 'en'),
	  )); ?>
		<?php echo $form->error($model,'time_start'); ?>
		<?php echo $form->labelEx($model,'time_end'); ?>
		<?php $this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
	 			'model' => $model,
	 			'attribute' => 'time_end',
				'options'	=>	array('dateFormat' => 'yy-mm-dd', 'hourFormat' => 'h:m:s', 'language' => 'en'),
	  )); ?>
		<?php echo $form->error($model,'time_end'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'b_number'); ?>
		<?php echo $form->textField($model,'b_number'); ?>
		<?php echo $form->error($model,'b_number'); ?>
		<?php echo $form->labelEx($model,'cpid'); ?>
		<?php echo $form->textField($model,'cpid'); ?>
		<?php echo $form->error($model,'cpid'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Tìm kiếm'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
$this->widget('CdrCGridViews', array(
	'id'=>'cdr-summary-grid',
	'dataProvider'=>$dataProvider,
	'template'=>"{summary}\n{items}\n{pager}",
	'columns'=>array(
		'cpid::ntext',
		'b_number::ntext',
		'trucuocthanhcong::number',
		'trucuockothanhcong::number',
		'kophatsinhcuoc::number',
		'tongsanluong::number',
		'doanhthu::number',
	),
));