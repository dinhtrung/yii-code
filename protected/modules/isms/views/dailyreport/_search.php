<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_dailyreport'); ?>
		<?php echo $form->textField($model,'id_dailyreport'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_sent'); ?>
		<?php echo $form->textField($model,'sms_sent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'block_sent'); ?>
		<?php echo $form->textField($model,'block_sent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sms_delivered'); ?>
		<?php echo $form->textField($model,'sms_delivered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'block_delivered'); ?>
		<?php echo $form->textField($model,'block_delivered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'campaign_id'); ?>
		<?php echo $form->textField($model,'campaign_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->