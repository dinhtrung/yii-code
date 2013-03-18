<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tree-form',
	'enableAjaxValidation'=>true,
)); 
	echo $form->errorSummary($model);
?>
<div class="row">
<?php echo $form->labelEx($model,'root'); ?>
<?php echo $form->textField($model,'root',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'root'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'lft'); ?>
<?php echo $form->textField($model,'lft',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'lft'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'rgt'); ?>
<?php echo $form->textField($model,'rgt',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'rgt'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'level'); ?>
<?php echo $form->textField($model,'level'); ?>
<?php echo $form->error($model,'level'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
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
