<?php
/* @var $this NotesController */
/* @var $model Notes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

<?php $this->beginClip("notes"); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'root'); ?>
		<?php echo $form->dropDownList($model,'root', array('' => Yii::t('projects', '--- Select Parent Note ---' )) + Notes::getOptions()); ?>
		<?php echo $form->error($model,'root'); ?>
		<p class="hint"><?php echo Yii::t('projects', 'Ghi chú cấp trên của nội dung này.'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hours'); ?>
		<?php echo $form->textField($model,'hours'); ?>
		<?php echo $form->error($model,'hours'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'code'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

<?php $this->endClip(); ?>

<?php
$this->widget("CTabView", array(
	"tabs"	=>	array(
	    "notes"=>array(
	          "title"	=>	Yii::t("app", "notes"),
	          "content"	=>	$this->clips["notes"],
	    ),
	)
));
?>	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Save')); ?>
		<?php echo CHtml::resetButton(Yii::t('app', 'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->