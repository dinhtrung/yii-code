<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tags-form',
	'enableAjaxValidation'=>true,
)); 
	echo $form->errorSummary($model);
?>
<div class="row">
<?php echo $form->labelEx($model,'name'); ?>
<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
<?php echo $form->error($model,'name'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'frequency'); ?>
<?php echo $form->textField($model,'frequency'); ?>
<?php echo $form->error($model,'frequency'); ?>
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
