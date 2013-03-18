<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	'enableAjaxValidation'=>true,
)); 
	echo $form->errorSummary($model);
?>
<div class="row">
<?php echo $form->labelEx($model,'entity'); ?>
<?php echo $form->textField($model,'entity',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'entity'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'pkey'); ?>
<?php echo $form->textField($model,'pkey'); ?>
<?php echo $form->error($model,'pkey'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'uid'); ?>
<?php echo $form->textField($model,'uid'); ?>
<?php echo $form->error($model,'uid'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'createtime'); ?>
<?php echo $form->textField($model,'createtime'); ?>
<?php echo $form->error($model,'createtime'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'visible'); ?>
<?php echo $form->checkBox($model,'visible'); ?>
<?php echo $form->error($model,'visible'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'comment'); ?>
<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'comment'); ?>
</div>


<?php
echo CHtml::Button(
	Yii::t('app', 'Cancel'),
	array(
		'onClick' => "$('#".$relation."_dialog').dialog('close');"
	));
echo CHtml::Button(
	Yii::t('app', 'Create'),
	array(
		'id' => "submit_".$relation
	));
$this->endWidget(); 

?></div> <!-- form -->
