<?php
/* @var $this UcbController */
/* @var $model Ucb */

$this->breadcrumbs=array(
	'Ucbs'=>array('index'),
	$model->data_timestamp=>array('view','id'=>$model->data_timestamp),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ucb', 'url'=>array('index')),
	array('label'=>'Create Ucb', 'url'=>array('create')),
	array('label'=>'View Ucb', 'url'=>array('view', 'id'=>$model->data_timestamp)),
	array('label'=>'Manage Ucb', 'url'=>array('admin')),
);
?>

<h1>Update Ucb <?php echo $model->data_timestamp; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>