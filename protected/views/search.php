<?php
/* @var $this CdrController */
/* @var $model Cdr */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cdr-search-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'a_number'); ?>
		<?php echo $form->textField($model,'a_number'); ?>
		<?php echo $form->error($model,'a_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'b_number'); ?>
		<?php echo $form->textField($model,'b_number'); ?>
		<?php echo $form->error($model,'b_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpid'); ?>
		<?php echo $form->textField($model,'cpid'); ?>
		<?php echo $form->error($model,'cpid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contentid'); ?>
		<?php echo $form->textField($model,'contentid'); ?>
		<?php echo $form->error($model,'contentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo $form->textField($model,'cost'); ?>
		<?php echo $form->error($model,'cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'channeltype'); ?>
		<?php echo $form->textField($model,'channeltype'); ?>
		<?php echo $form->error($model,'channeltype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'information'); ?>
		<?php echo $form->textField($model,'information'); ?>
		<?php echo $form->error($model,'information'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eventid'); ?>
		<?php echo $form->textField($model,'eventid'); ?>
		<?php echo $form->error($model,'eventid'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->