<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-form',
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
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'description'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'name'); ?>
<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'name'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'path'); ?>
<?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'path'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'parent_id'); ?>
<?php echo $form->textField($model,'parent_id'); ?>
<?php echo $form->error($model,'parent_id'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'version'); ?>
<?php echo $form->textField($model,'version'); ?>
<?php echo $form->error($model,'version'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'ext'); ?>
<?php echo $form->textField($model,'ext',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'ext'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'size'); ?>
<?php echo $form->textField($model,'size',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'size'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'type'); ?>
<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'type'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'entity'); ?>
<?php echo $form->textField($model,'entity',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'entity'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'pkey'); ?>
<?php echo $form->textField($model,'pkey',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'pkey'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'createtime'); ?>
<?php echo $form->textField($model,'createtime',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'createtime'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'updatetime'); ?>
<?php echo $form->textField($model,'updatetime',array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->error($model,'updatetime'); ?>
</div>


<?php
echo CHtml::Button(
	Yii::t('cms', 'Cancel'),
	array(
		'onClick' => "$('#".$relation."_dialog').dialog('close');"
	));
echo CHtml::Button(
	Yii::t('cms', 'Create'),
	array(
		'id' => "submit_".$relation
	));
$this->endWidget();

?></div> <!-- form -->
