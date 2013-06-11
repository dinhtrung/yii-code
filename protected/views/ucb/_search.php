<?php
/* @var $this UcbController */
/* @var $model Ucb */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'data_timestamp'); ?>
		<?php echo $form->textField($model,'data_timestamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'node_id'); ?>
		<?php echo $form->textField($model,'node_id',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg1_cg'); ?>
		<?php echo $form->textField($model,'leg1_cg',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg1_cd'); ?>
		<?php echo $form->textField($model,'leg1_cd',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg1_starttime'); ?>
		<?php echo $form->textField($model,'leg1_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg1_answertime'); ?>
		<?php echo $form->textField($model,'leg1_answertime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg1_endtime'); ?>
		<?php echo $form->textField($model,'leg1_endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg1_callduration'); ?>
		<?php echo $form->textField($model,'leg1_callduration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg1_status'); ?>
		<?php echo $form->textField($model,'leg1_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg2_cg'); ?>
		<?php echo $form->textField($model,'leg2_cg',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg2_cd'); ?>
		<?php echo $form->textField($model,'leg2_cd',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg2_starttime'); ?>
		<?php echo $form->textField($model,'leg2_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg2_answertime'); ?>
		<?php echo $form->textField($model,'leg2_answertime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg2_endtime'); ?>
		<?php echo $form->textField($model,'leg2_endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg2_callduration'); ?>
		<?php echo $form->textField($model,'leg2_callduration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leg2_status'); ?>
		<?php echo $form->textField($model,'leg2_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bridge_starttime'); ?>
		<?php echo $form->textField($model,'bridge_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bridge_endtime'); ?>
		<?php echo $form->textField($model,'bridge_endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bridge_callduration'); ?>
		<?php echo $form->textField($model,'bridge_callduration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ivr_cd'); ?>
		<?php echo $form->textField($model,'ivr_cd',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ivr_starttime'); ?>
		<?php echo $form->textField($model,'ivr_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ivr_answertime'); ?>
		<?php echo $form->textField($model,'ivr_answertime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ivr_endtime'); ?>
		<?php echo $form->textField($model,'ivr_endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ivr_callduration'); ?>
		<?php echo $form->textField($model,'ivr_callduration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ivr_status'); ?>
		<?php echo $form->textField($model,'ivr_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'getnotif_status'); ?>
		<?php echo $form->textField($model,'getnotif_status',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notif_type'); ?>
		<?php echo $form->textField($model,'notif_type',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notif_status'); ?>
		<?php echo $form->textField($model,'notif_status',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'call_type'); ?>
		<?php echo $form->textField($model,'call_type',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subscriber_type'); ?>
		<?php echo $form->textField($model,'subscriber_type',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'redial_type'); ?>
		<?php echo $form->textField($model,'redial_type',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chargingprefix'); ?>
		<?php echo $form->textField($model,'chargingprefix',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reverse_type'); ?>
		<?php echo $form->textField($model,'reverse_type',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diameter_status'); ?>
		<?php echo $form->textField($model,'diameter_status',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diameter_status_refund'); ?>
		<?php echo $form->textField($model,'diameter_status_refund',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'getredial_status'); ?>
		<?php echo $form->textField($model,'getredial_status',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updateredial_status'); ?>
		<?php echo $form->textField($model,'updateredial_status',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cdr_inserthistory_status'); ?>
		<?php echo $form->textField($model,'cdr_inserthistory_status',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'calling_vlr'); ?>
		<?php echo $form->textField($model,'calling_vlr',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'called_vlr'); ?>
		<?php echo $form->textField($model,'called_vlr',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->