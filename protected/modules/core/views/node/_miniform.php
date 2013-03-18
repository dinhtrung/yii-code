<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'node-form',
	'enableAjaxValidation'=>true,
)); 
	echo $form->errorSummary($model);
?>
<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'body'); ?>
<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'body'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'createtime'); ?>
<?php echo $form->textField($model,'createtime'); ?>
<?php echo $form->error($model,'createtime'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'updatetime'); ?>
<?php echo $form->textField($model,'updatetime'); ?>
<?php echo $form->error($model,'updatetime'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'uid'); ?>
<?php echo $form->textField($model,'uid'); ?>
<?php echo $form->error($model,'uid'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'category'); ?>
<?php echo $form->textField($model,'category'); ?>
<?php echo $form->error($model,'category'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'tags'); ?>
<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'tags'); ?>
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
