<?php
/* @var $this TaskLogController */
/* @var $model TaskLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-log-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

<?php $this->beginClip("task-log"); ?>	<div class="row">
		<?php echo $form->labelEx($model,'task'); ?>
		<?php echo $form->textField($model,'task'); ?>
		<?php echo $form->error($model,'task'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creator'); ?>
		<?php echo $form->textField($model,'creator'); ?>
		<?php echo $form->error($model,'creator'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hours'); ?>
		<?php echo $form->textField($model,'hours'); ?>
		<?php echo $form->error($model,'hours'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'costcode'); ?>
		<?php echo $form->textField($model,'costcode',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'costcode'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'problem'); ?>
		<?php echo $form->textField($model,'problem'); ?>
		<?php echo $form->error($model,'problem'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reference'); ?>
		<?php echo $form->textField($model,'reference'); ?>
		<?php echo $form->error($model,'reference'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'related_url'); ?>
		<?php echo $form->textField($model,'related_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'related_url'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createtime'); ?>
		<?php echo $form->textField($model,'createtime'); ?>
		<?php echo $form->error($model,'createtime'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updatetime'); ?>
		<?php echo $form->textField($model,'updatetime'); ?>
		<?php echo $form->error($model,'updatetime'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

<?php $this->endClip(); ?>

<?php
$this->widget("CTabView", array(
	"tabs"	=>	array(
	    "task-log"=>array(
	          "title"	=>	Yii::t("app", "task-log"),
	          "content"	=>	$this->clips["task-log"],
	    ),
	)
));
?>	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Save')); ?>
		<?php echo CHtml::resetButton(Yii::t('app', 'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->