<?php
/* @var $this FieldconfigController */
/* @var $model Fieldconfig */

$this->breadcrumbs=array(
	'Fieldconfigs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Fieldconfig', 'url'=>array('index')),
	array('label'=>'Create Fieldconfig', 'url'=>array('create')),
	array('label'=>'Update Fieldconfig', 'url'=>array('update', 'id'=>$model->name)),
	array('label'=>'Delete Fieldconfig', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->name),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fieldconfig', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->pageTitle = Yii::t('app', 'Fieldconfig :title Details', array(':title' => $model->getTitle())); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'option',
		'type',
		'owner',
		'rules',
	),
)); ?>
