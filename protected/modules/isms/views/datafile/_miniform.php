<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'file-form',
	'enableAjaxValidation' => true,
));
echo $form->errorSummary($model);
?>
<div class="row">
<?php echo $form->labelEx($model, 'uid'); ?>
<?php echo $form->textField($model, 'uid', array(
	'size' => 10,
	'maxlength' => 10
)); ?>
<?php echo $form->error($model, 'uid'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'filename'); ?>
<?php echo $form->textField($model, 'filename', array(
	'size' => 60,
	'maxlength' => 255
)); ?>
<?php echo $form->error($model, 'filename'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'uri'); ?>
<?php echo $form->textField($model, 'uri', array(
	'size' => 60,
	'maxlength' => 255
)); ?>
<?php echo $form->error($model, 'uri'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'filemime'); ?>
<?php echo $form->textField($model, 'filemime', array(
	'size' => 60,
	'maxlength' => 255
)); ?>
<?php echo $form->error($model, 'filemime'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'filesize'); ?>
<?php echo $form->textField($model, 'filesize', array(
	'size' => 10,
	'maxlength' => 10
)); ?>
<?php echo $form->error($model, 'filesize'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'status'); ?>
<?php echo $form->textField($model, 'status'); ?>
<?php echo $form->error($model, 'status'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'timestamp'); ?>
<?php echo $form->textField($model, 'timestamp', array(
	'size' => 10,
	'maxlength' => 10
)); ?>
<?php echo $form->error($model, 'timestamp'); ?>
</div>


<?php
echo CHtml::Button(Yii::t('isms', 'Cancel') , array(
	'onClick' => "$('#" . $relation . "_dialog').dialog('close');"
));
echo CHtml::Button(Yii::t('isms', 'Create') , array(
	'id' => "submit_" . $relation
));
$this->endWidget();
?></div> <!-- form -->
