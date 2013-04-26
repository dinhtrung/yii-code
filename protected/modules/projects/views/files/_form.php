<?php
/* @var $this FilesController */
/* @var $model Files */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'files-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

<?php $this->beginClip("files"); ?>	<div class="row">
		<?php echo $form->labelEx($model,'real_filename'); ?>
		<?php echo $form->textField($model,'real_filename',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'real_filename'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'folder'); ?>
		<?php echo $form->textField($model,'folder'); ?>
		<?php echo $form->error($model,'folder'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project'); ?>
		<?php echo $form->textField($model,'project'); ?>
		<?php echo $form->error($model,'project'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'task'); ?>
		<?php echo $form->textField($model,'task'); ?>
		<?php echo $form->error($model,'task'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'type'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->textField($model,'owner'); ?>
		<?php echo $form->error($model,'owner'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size'); ?>
		<?php echo $form->textField($model,'size'); ?>
		<?php echo $form->error($model,'size'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version'); ?>
		<?php echo $form->textField($model,'version'); ?>
		<?php echo $form->error($model,'version'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icon'); ?>
		<?php echo $form->textField($model,'icon',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'icon'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category'); ?>
		<?php echo $form->error($model,'category'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'checkout'); ?>
		<?php echo $form->textField($model,'checkout',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'checkout'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'co_reason'); ?>
		<?php echo $form->textArea($model,'co_reason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'co_reason'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version_id'); ?>
		<?php echo $form->textField($model,'version_id'); ?>
		<?php echo $form->error($model,'version_id'); ?>
		<p class="hint"><?php echo Yii::t('projects', '@HINT FOR $column->name'); ?></p>
	</div>

<?php $this->endClip(); ?>

<?php
$this->widget("CTabView", array(
	"tabs"	=>	array(
	    "files"=>array(
	          "title"	=>	Yii::t("app", "files"),
	          "content"	=>	$this->clips["files"],
	    ),
	)
));
?>	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Save')); ?>
		<?php echo CHtml::resetButton(Yii::t('app', 'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->