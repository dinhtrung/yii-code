<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'web-menu-form',
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
<?php echo $form->labelEx($model,'label'); ?>
<?php echo $form->textField($model,'label',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'label'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'url'); ?>
<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'url'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'template'); ?>
<?php echo $form->textField($model,'template',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'template'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'visible'); ?>
<?php echo $form->checkBox($model,'visible'); ?>
<?php echo $form->error($model,'visible'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'icon'); ?>
<?php echo $form->textField($model,'icon',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'icon'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'task'); ?>
<?php echo $form->textField($model,'task',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'task'); ?>
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
