<?php
/* @var $this UcbController */
/* @var $model Ucb */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ucb-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'data_timestamp'); ?>
		<?php echo $form->textField($model,'data_timestamp'); ?>
		<?php echo $form->error($model,'data_timestamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'node_id'); ?>
		<?php echo $form->textField($model,'node_id',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'node_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg1_cg'); ?>
		<?php echo $form->textField($model,'leg1_cg',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'leg1_cg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg1_cd'); ?>
		<?php echo $form->textField($model,'leg1_cd',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'leg1_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg1_starttime'); ?>
		<?php echo $form->textField($model,'leg1_starttime'); ?>
		<?php echo $form->error($model,'leg1_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg1_answertime'); ?>
		<?php echo $form->textField($model,'leg1_answertime'); ?>
		<?php echo $form->error($model,'leg1_answertime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg1_endtime'); ?>
		<?php echo $form->textField($model,'leg1_endtime'); ?>
		<?php echo $form->error($model,'leg1_endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg1_callduration'); ?>
		<?php echo $form->textField($model,'leg1_callduration'); ?>
		<?php echo $form->error($model,'leg1_callduration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg1_status'); ?>
		<?php echo $form->textField($model,'leg1_status'); ?>
		<?php echo $form->error($model,'leg1_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg2_cg'); ?>
		<?php echo $form->textField($model,'leg2_cg',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'leg2_cg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg2_cd'); ?>
		<?php echo $form->textField($model,'leg2_cd',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'leg2_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg2_starttime'); ?>
		<?php echo $form->textField($model,'leg2_starttime'); ?>
		<?php echo $form->error($model,'leg2_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg2_answertime'); ?>
		<?php echo $form->textField($model,'leg2_answertime'); ?>
		<?php echo $form->error($model,'leg2_answertime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg2_endtime'); ?>
		<?php echo $form->textField($model,'leg2_endtime'); ?>
		<?php echo $form->error($model,'leg2_endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg2_callduration'); ?>
		<?php echo $form->textField($model,'leg2_callduration'); ?>
		<?php echo $form->error($model,'leg2_callduration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leg2_status'); ?>
		<?php echo $form->textField($model,'leg2_status'); ?>
		<?php echo $form->error($model,'leg2_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bridge_starttime'); ?>
		<?php echo $form->textField($model,'bridge_starttime'); ?>
		<?php echo $form->error($model,'bridge_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bridge_endtime'); ?>
		<?php echo $form->textField($model,'bridge_endtime'); ?>
		<?php echo $form->error($model,'bridge_endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bridge_callduration'); ?>
		<?php echo $form->textField($model,'bridge_callduration'); ?>
		<?php echo $form->error($model,'bridge_callduration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ivr_cd'); ?>
		<?php echo $form->textField($model,'ivr_cd',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ivr_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ivr_starttime'); ?>
		<?php echo $form->textField($model,'ivr_starttime'); ?>
		<?php echo $form->error($model,'ivr_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ivr_answertime'); ?>
		<?php echo $form->textField($model,'ivr_answertime'); ?>
		<?php echo $form->error($model,'ivr_answertime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ivr_endtime'); ?>
		<?php echo $form->textField($model,'ivr_endtime'); ?>
		<?php echo $form->error($model,'ivr_endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ivr_callduration'); ?>
		<?php echo $form->textField($model,'ivr_callduration'); ?>
		<?php echo $form->error($model,'ivr_callduration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ivr_status'); ?>
		<?php echo $form->textField($model,'ivr_status'); ?>
		<?php echo $form->error($model,'ivr_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'getnotif_status'); ?>
		<?php echo $form->textField($model,'getnotif_status',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'getnotif_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notif_type'); ?>
		<?php echo $form->textField($model,'notif_type',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'notif_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notif_status'); ?>
		<?php echo $form->textField($model,'notif_status',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'notif_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'call_type'); ?>
		<?php echo $form->textField($model,'call_type',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'call_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subscriber_type'); ?>
		<?php echo $form->textField($model,'subscriber_type',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'subscriber_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'redial_type'); ?>
		<?php echo $form->textField($model,'redial_type',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'redial_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chargingprefix'); ?>
		<?php echo $form->textField($model,'chargingprefix',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'chargingprefix'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reverse_type'); ?>
		<?php echo $form->textField($model,'reverse_type',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'reverse_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diameter_status'); ?>
		<?php echo $form->textField($model,'diameter_status',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'diameter_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diameter_status_refund'); ?>
		<?php echo $form->textField($model,'diameter_status_refund',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'diameter_status_refund'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'getredial_status'); ?>
		<?php echo $form->textField($model,'getredial_status',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'getredial_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updateredial_status'); ?>
		<?php echo $form->textField($model,'updateredial_status',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'updateredial_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cdr_inserthistory_status'); ?>
		<?php echo $form->textField($model,'cdr_inserthistory_status',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'cdr_inserthistory_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'calling_vlr'); ?>
		<?php echo $form->textField($model,'calling_vlr',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'calling_vlr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'called_vlr'); ?>
		<?php echo $form->textField($model,'called_vlr',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'called_vlr'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->