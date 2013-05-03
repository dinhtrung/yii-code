<?php
/* @var $this DepartmentsController */
/* @var $data Departments */
?>

<div class="view">

	<h3><?php echo $data->link; ?></h3>

<div class="box">
<?php $this->beginWidget('CMarkdown'); ?><?php echo $data->description; ?><?php $this->endWidget(); ?>
</div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('root')); ?>:</b>
	<?php echo CHtml::encode($data->root); ?>
	<br />

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=> $data,
	'attributes'=>array(
		'phone',
		'fax',
		'address',
		'city',
		'state',
		'zip',
		'url:url',
		'createtime:datetime',
		'updatetime:datetime',
	),
)); ?>

</div>