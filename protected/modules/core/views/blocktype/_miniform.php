<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blocktype-form',
	'enableAjaxValidation'=>true,
)); 
	echo $form->errorSummary($model);
?>
<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
<?php echo $form->error($model,'title'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'component'); ?>
<?php echo $form->textField($model,'component',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'component'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'callback'); ?>
<?php echo $form->textField($model,'callback',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'callback'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'viewfile'); ?>
<?php echo $form->textField($model,'viewfile',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'viewfile'); ?>
</div>


<?php
echo CHtml::Button(
	Yii::t('core', 'Cancel'),
	array(
		'onClick' => "$('#".$relation."_dialog').dialog('close');"
	));
echo CHtml::Button(
	Yii::t('core', 'Create'),
	array(
		'id' => "submit_".$relation
	));
$this->endWidget(); 

?></div> <!-- form -->
