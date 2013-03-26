<div class="form">
<p class="note">
<?php echo Yii::t('isms','Fields with');?> <span class="required">*</span> <?php echo Yii::t('isms','are required');?>.
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'worktime-form',
	'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>
	<div class="row">
<?php echo $form->labelEx($model,'start'); ?>
<?php $this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
	     'model'			=> $model,
	     'attribute'		=> 'start',
	     'options'			=>  array(
			 'timeOnly' 	=> TRUE,
	     ),
	     'htmlOptions'		=> array('size'=>5,'maxlength'=>5)
	)); ?>
<?php echo $form->error($model,'start'); ?>
<?php if('_HINT_Worktime.start' != $hint = Yii::t('isms', '_HINT_Worktime.start')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'end'); ?>
<?php $this->widget('ext.widgets.datetimepicker.CJuiDateTimePicker', array(
	     'model'			=> $model,
	     'attribute'		=> 'end',
	     'options'			=>  array(
			 'timeOnly' 	=> TRUE,
	     ),
	     'htmlOptions'		=> array('size'=>5,'maxlength'=>5)
	)); ?>
<?php echo $form->error($model,'end'); ?>
<?php if('_HINT_Worktime.end' != $hint = Yii::t('isms', '_HINT_Worktime.end')) echo $hint; ?>
</div>


<?php
echo CHtml::Button(Yii::t('isms', 'Cancel'), array(
			'submit' => array('worktime/admin')));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
