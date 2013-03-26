<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dailyreport-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms_sent'); ?>
		<?php echo $form->textField($model,'sms_sent'); ?>
		<?php echo $form->error($model,'sms_sent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'block_sent'); ?>
		<?php echo $form->textField($model,'block_sent'); ?>
		<?php echo $form->error($model,'block_sent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sms_delivered'); ?>
		<?php echo $form->textField($model,'sms_delivered'); ?>
		<?php echo $form->error($model,'sms_delivered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'block_delivered'); ?>
		<?php echo $form->textField($model,'block_delivered'); ?>
		<?php echo $form->error($model,'block_delivered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'campaign_id'); ?>
		<?php echo $form->textField($model,'campaign_id'); ?>
		<?php echo $form->error($model,'campaign_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->