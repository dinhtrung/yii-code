<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'template-form',
	'enableAjaxValidation' => true,
));
echo $form->errorSummary($model);
?>
	<div class="row">
<?php echo $form->labelEx($model, 'title'); ?>
<?php echo $form->textField($model, 'title', array(
	'size' => 40,
	'maxlength' => 40
)); ?>
<?php echo $form->error($model, 'title'); ?>
<p class="hint"><?php if ('_HINT_Template.title' != $hint = Yii::t('isms', '_HINT_Template.title')) echo $hint; ?></p>
</div>

<div class="row">
<?php echo $form->labelEx($model, 'body'); ?>
<?php echo $form->textArea($model, 'body', array(
	'rows' => 6,
	'cols' => 50
)); ?>
<?php echo $form->error($model, 'body'); ?>
<p class="hint"><?php if ('_HINT_Template.body' != $hint = Yii::t('isms', '_HINT_Template.body')) echo $hint; ?></p>
</div>


<?php
echo CHtml::Button(Yii::t('isms', 'Cancel') , array(
	'submit' => array(
		'template/admin'
	)
));
echo CHtml::submitButton(Yii::t('isms', 'Save'));
$this->endWidget(); ?>
</div> <!-- form -->
