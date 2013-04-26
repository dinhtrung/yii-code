<?php
/* @var $this ForumsController */
/* @var $model Forums */

$this->breadcrumbs=array(
	'Forums'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Forums', 'url'=>array('index')),
	array('label'=>'Create Forums', 'url'=>array('create')),
	array('label'=>'Update Forums', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Forums', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Forums', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Forums :title Details', array(':title' => $model->getTitle())); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project',
		'status',
		'owner',
		'name',
		'last_id',
		'message_count',
		'description',
		'moderated',
		'createtime',
		'updatetime',
	),
)); ?>
