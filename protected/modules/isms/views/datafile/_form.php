<div class="form">
<p class="note">
<?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?>
</p>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'file-form',
	'enableAjaxValidation' => FALSE,
	'htmlOptions' => array(
			'enctype' => 'multipart/form-data'
	) ,
));
echo $form->errorSummary($model);
?>

<div class="row">
<?php echo $form->labelEx($model, 'title'); ?>
<?php echo $form->textField($model, 'title', array(
	'size' => 40,
	'maxlength' => 255,
	'class'	=>	'large'
)); ?>
<?php echo $form->error($model, 'title'); ?>
<?php if ('_HINT_File.title' != $hint = Yii::t('isms', '_HINT_File.title')) echo $hint; ?>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'description'); ?>
<?php echo $form->textArea($model, 'description', array(
	'rows' => 6,
	'cols' => 50
)); ?>
<?php echo $form->error($model, 'description'); ?>
<?php if ('_HINT_File.description' != $hint = Yii::t('isms', '_HINT_File.description')) echo $hint; ?>
</div>


<div class="row">
<?php echo $form->labelEx($model, 'filepath'); ?>
<?php echo $form->fileField($model, 'filepath'); ?>
<?php echo $form->error($model, 'filepath'); ?>
<?php if ('_HINT_File.filepath' != $hint = Yii::t('isms', '_HINT_File.filepath')) echo $hint; ?>
</div>



<?php
echo CHtml::Button(Yii::t('isms', 'Cancel') , array(
	'submit' => array(
		'file/admin'
	)
));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
