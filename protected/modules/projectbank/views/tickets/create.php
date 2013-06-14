<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tickets','url'=>array('index')),
	array('label'=>'Manage Tickets','url'=>array('admin')),
);
?>

<h1>Create Tickets</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>