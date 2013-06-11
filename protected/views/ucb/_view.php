<?php
/* @var $this UcbController */
/* @var $data Ucb */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_timestamp')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->data_timestamp), array('view', 'id'=>$data->data_timestamp)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('node_id')); ?>:</b>
	<?php echo CHtml::encode($data->node_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg1_cg')); ?>:</b>
	<?php echo CHtml::encode($data->leg1_cg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg1_cd')); ?>:</b>
	<?php echo CHtml::encode($data->leg1_cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg1_starttime')); ?>:</b>
	<?php echo CHtml::encode($data->leg1_starttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg1_answertime')); ?>:</b>
	<?php echo CHtml::encode($data->leg1_answertime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg1_endtime')); ?>:</b>
	<?php echo CHtml::encode($data->leg1_endtime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('leg1_callduration')); ?>:</b>
	<?php echo CHtml::encode($data->leg1_callduration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg1_status')); ?>:</b>
	<?php echo CHtml::encode($data->leg1_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg2_cg')); ?>:</b>
	<?php echo CHtml::encode($data->leg2_cg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg2_cd')); ?>:</b>
	<?php echo CHtml::encode($data->leg2_cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg2_starttime')); ?>:</b>
	<?php echo CHtml::encode($data->leg2_starttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg2_answertime')); ?>:</b>
	<?php echo CHtml::encode($data->leg2_answertime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg2_endtime')); ?>:</b>
	<?php echo CHtml::encode($data->leg2_endtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg2_callduration')); ?>:</b>
	<?php echo CHtml::encode($data->leg2_callduration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leg2_status')); ?>:</b>
	<?php echo CHtml::encode($data->leg2_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bridge_starttime')); ?>:</b>
	<?php echo CHtml::encode($data->bridge_starttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bridge_endtime')); ?>:</b>
	<?php echo CHtml::encode($data->bridge_endtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bridge_callduration')); ?>:</b>
	<?php echo CHtml::encode($data->bridge_callduration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ivr_cd')); ?>:</b>
	<?php echo CHtml::encode($data->ivr_cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ivr_starttime')); ?>:</b>
	<?php echo CHtml::encode($data->ivr_starttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ivr_answertime')); ?>:</b>
	<?php echo CHtml::encode($data->ivr_answertime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ivr_endtime')); ?>:</b>
	<?php echo CHtml::encode($data->ivr_endtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ivr_callduration')); ?>:</b>
	<?php echo CHtml::encode($data->ivr_callduration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ivr_status')); ?>:</b>
	<?php echo CHtml::encode($data->ivr_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('getnotif_status')); ?>:</b>
	<?php echo CHtml::encode($data->getnotif_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notif_type')); ?>:</b>
	<?php echo CHtml::encode($data->notif_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notif_status')); ?>:</b>
	<?php echo CHtml::encode($data->notif_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('call_type')); ?>:</b>
	<?php echo CHtml::encode($data->call_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subscriber_type')); ?>:</b>
	<?php echo CHtml::encode($data->subscriber_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('redial_type')); ?>:</b>
	<?php echo CHtml::encode($data->redial_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chargingprefix')); ?>:</b>
	<?php echo CHtml::encode($data->chargingprefix); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reverse_type')); ?>:</b>
	<?php echo CHtml::encode($data->reverse_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diameter_status')); ?>:</b>
	<?php echo CHtml::encode($data->diameter_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diameter_status_refund')); ?>:</b>
	<?php echo CHtml::encode($data->diameter_status_refund); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('getredial_status')); ?>:</b>
	<?php echo CHtml::encode($data->getredial_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateredial_status')); ?>:</b>
	<?php echo CHtml::encode($data->updateredial_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cdr_inserthistory_status')); ?>:</b>
	<?php echo CHtml::encode($data->cdr_inserthistory_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('calling_vlr')); ?>:</b>
	<?php echo CHtml::encode($data->calling_vlr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('called_vlr')); ?>:</b>
	<?php echo CHtml::encode($data->called_vlr); ?>
	<br />

	*/ ?>

</div>