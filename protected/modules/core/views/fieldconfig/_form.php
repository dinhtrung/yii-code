<?php
/* @var $this FieldconfigController */
/* @var $model Fieldconfig */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fieldconfig-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

<?php $this->beginClip("fieldconfig"); ?>	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
		<p class="hint"><?php echo Yii::t('core', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'option'); ?>
		<?php echo $form->textArea($model,'option',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'option'); ?>
		<p class="hint"><?php echo Yii::t('core', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'type'); ?>
		<p class="hint"><?php echo Yii::t('core', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->textField($model,'owner',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'owner'); ?>
		<p class="hint"><?php echo Yii::t('core', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rules'); ?>
		<?php echo $form->textField($model,'rules'); ?>
		<?php echo $form->error($model,'rules'); ?>
		<p class="hint"><?php echo Yii::t('core', '@HINT FOR $column->name'); ?></p>
	</div>

<?php $this->endClip(); ?>

<?php
$this->widget("CTabView", array(
	"tabs"	=>	array(
	    "fieldconfig"=>array(
	          "title"	=>	Yii::t("app", "fieldconfig"),
	          "content"	=>	$this->clips["fieldconfig"],
	    ),
	)
));
?>	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Save')); ?>
		<?php echo CHtml::resetButton(Yii::t('app', 'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->