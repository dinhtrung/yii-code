<div class="view">

<h3>	<?php echo CHtml::link(CHtml::encode($data, array('view', 'id'=>$data->btid))); ?>
</h3>

<div>
<?php $this->beginWidget("CMarkdown");
echo $data->description;
$this->endWidget(); ?>

</div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('component')); ?>:</b>
	<?php echo CHtml::encode($data->component); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('callback')); ?>:</b>
	<?php echo CHtml::encode($data->callback); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viewfile')); ?>:</b>
	<?php echo CHtml::encode($data->viewfile); ?>
	<br />


</div>
