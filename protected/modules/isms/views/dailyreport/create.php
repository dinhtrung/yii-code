<?php
$this->breadcrumbs=array(
	'Dailyreports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dailyreport', 'url'=>array('index')),
	array('label'=>'Manage Dailyreport', 'url'=>array('admin')),
);
?>

<h1>Create Dailyreport</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>