<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_dailyreport')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_dailyreport), array('view', 'id'=>$data->id_dailyreport)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_sent')); ?>:</b>
	<?php echo CHtml::encode($data->sms_sent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('block_sent')); ?>:</b>
	<?php echo CHtml::encode($data->block_sent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sms_delivered')); ?>:</b>
	<?php echo CHtml::encode($data->sms_delivered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('block_delivered')); ?>:</b>
	<?php echo CHtml::encode($data->block_delivered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campaign_id')); ?>:</b>
	<?php echo CHtml::encode($data->campaign_id); ?>
	<br />


</div>