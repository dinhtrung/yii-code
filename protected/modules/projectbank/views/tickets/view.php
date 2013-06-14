<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Tickets','url'=>array('index')),
	array('label'=>'Create Tickets','url'=>array('create')),
	array('label'=>'Update Tickets','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Tickets','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tickets','url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = $model->title; ?></h1>

<?php $this->beginWidget('CMarkdown'); ?><?php echo CHtml::encode($model->body); ?><?php $this->endWidget(); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'createtime:datetime',
		'updatetime:datetime',
		'user:html',
		'project:html',
	),
)); ?>
