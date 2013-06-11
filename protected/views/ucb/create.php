<?php
/* @var $this UcbController */
/* @var $model Ucb */

$this->breadcrumbs=array(
	'Ucbs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ucb', 'url'=>array('index')),
	array('label'=>'Manage Ucb', 'url'=>array('admin')),
);
?>

<h1>Create Ucb</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>