<div class="form">
<p class="note">
<?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?>
</p>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'organization-form',
	'enableAjaxValidation' => true,
));
echo $form->errorSummary($model);
?>
	<div class="row">
<?php echo $form->labelEx($model, 'title'); ?>
<?php echo $form->textField($model, 'title', array(
	'size' => 60,
	'maxlength' => 255
)); ?>
<?php echo $form->error($model, 'title'); ?>
<p class="hint"><?php if ('_HINT_Organization.title' != $hint = Yii::t('isms', '_HINT_Organization.title')) echo $hint; ?></p>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'description'); ?>
<?php echo $form->textArea($model, 'description', array(
	'rows' => 6,
	'cols' => 50
)); ?>
<?php echo $form->error($model, 'description'); ?>
<p class="hint"><?php if ('_HINT_Organization.description' != $hint = Yii::t('isms', '_HINT_Organization.description')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('isms', 'Cancel') , array(
	'submit' => array(
		'organization/admin'
	)
));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
